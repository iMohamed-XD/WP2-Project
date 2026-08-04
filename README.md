# AIU GYM — Multi-Department Gym Management System

A Laravel 13 application that manages a gym organization split into five independent
departments: **Trainers**, **Members**, **Branches**, **Workouts**, and **Warehouses**.
Each department has its own users, its own routes, and its own data model, but several
models are shared or linked across departments (e.g. a `Workout` is visible to
Trainers, Branches, and Members).

---

## 1. Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 13 (PHP 8.3) |
| Auth | Laravel session auth (`Auth::attempt`), no Breeze/Jetstream scaffolding |
| Frontend | Blade + Bootstrap 5 (+ Bootstrap Icons), jQuery for AJAX filtering |
| Build | Vite + `laravel-vite-plugin`, Tailwind v4 (used only for a few Warehouse/Branch legacy views) |
| DB | Any Laravel-supported RDBMS (SQLite by default in tests) |
| Authorization | Laravel Gates/Policies (`TrainerPolicy`, `SportsTypePolicy`) |
| File storage | `public` disk (`storage:link`) for trainer images, member photos, workout images, warehouse brochures |

---

## 2. Access Control Model

Every department is gated by two middlewares stacked in `routes/web.php`:

```php
Route::middleware(['auth', 'department:<name>'])->group(function () {
    // department routes
});
```

- **`auth`** — standard authenticated-session check.
- **`department:<name>`** (`App\Http\Middleware\DepartmentMiddleware`) — compares the
  first URL segment against `Auth::user()->department->department`. A user whose
  department does not match the route prefix gets a `403`.

Each `User` belongs to a `role` (`employee` | `manager`) and a `department`
(`trainers` | `members` | `branches` | `warehouses` | `workouts`). Role determines
*what* a user can do inside their department (see `TrainerPolicy` below); department
determines *which* department's routes they can even reach.

Seeded accounts (see `UserSeeder` / `Users.md`): one manager + one employee per
department, e.g. `trainers.manager@gym.com` / `trainers.employee@gym.com`, password
`password` for all.

Login (`LoginController::login`) redirects post-auth based on the user's department:

```php
'trainers'   => redirect()->route('trainers.index'),
'members'    => redirect()->route('members.index'),
'branches'   => redirect()->route('branches.dashboard'),
'warehouses' => redirect()->route('warehouse.dashboard'),
'workouts'   => redirect()->route('workouts.dashboard'),
```

---

## 3. Core / Shared Tables

These aren't owned by a single module but are referenced by several:

| Table | Purpose |
|---|---|
| `users` | App accounts. FKs: `role_id`, `department_id`. |
| `roles` | `employee` \| `manager`. |
| `departments` | `trainers` \| `members` \| `branches` \| `warehouses` \| `workouts`. |
| `sports_types` | Shared taxonomy used by **Trainers** (specialization) and **Workouts** (category). |
| `countries` | Shared by **Branches** and **Warehouses**. |

> ⚠️ Naming note: `App\Models\role` and `App\Models\department` are declared with
> **lowercase class names** (`app/Models/role.php`, `app/Models/department.php`).
> This works on case-insensitive filesystems but violates PSR-4/Laravel model naming
> conventions and can break autoloading on case-sensitive filesystems (Linux CI/prod).
> Consider renaming to `Role` / `Department`.

---

## 4. Module: Trainers

### 4.1 Models

| Model | File | Notes |
|---|---|---|
| `Trainer` | `app/Models/Trainer.php` | `SoftDeletes`, `HasFactory` |
| `TrainerStatus` | `app/Models/TrainerStatus.php` | e.g. Active / On Leave / Loaned / Ended Contract |
| `SportsType` | `app/Models/SportsType.php` | shared with Workouts module |
| `TrainerWorkout` | `app/Models/TrainerWorkout.php` | pivot model for Trainer ↔ Workout |

`Trainer` also exposes a computed accessor `profile_picture_url` (via
`Attribute::make`) that resolves the trainer's `image` path through the `public`
disk, falling back to `asset('images/avatar-default.jpg')`.

### 4.2 Database Tables

**`trainers`**

| Column | Type | Constraints |
|---|---|---|
| `id` | bigint | PK |
| `firstname`, `lastname` | string | required |
| `fathername` | string | nullable |
| `phone` | string | required |
| `address` | string | nullable |
| `image` | string | nullable — path on `public` disk |
| `gender` | string | required |
| `sports_type_id` | FK → `sports_types.id` | indexed, `onDelete('restrict')` |
| `birthplace` | string | nullable |
| `birthdate` | date | required |
| `years_of_experience` | integer | indexed |
| `SSN` | string | **unique** |
| `email` | string | unique, nullable |
| `hiring_date` | date | required |
| `email_verified_at` | timestamp | nullable |
| `certification` | enum(`level_1`..`level_4`) | default `level_1` |
| `trainer_status_id` | FK → `trainer_statuses.id` | indexed, `onDelete('restrict')` |
| `remember_token`, `timestamps`, `deleted_at` | — | soft-deletable |

**`trainer_statuses`**: `id`, `status` (string), `timestamps`.

**`sports_types`**: `id`, `type` (string), `timestamps`.

**`trainer_workouts`** (pivot): `id`, `trainer_id` FK cascade, `workout_id` FK cascade,
`timestamps`.

### 4.3 Relationships

```
Trainer        belongsTo   SportsType      (sports_type_id)
Trainer        belongsTo   TrainerStatus   (trainer_status_id)
Trainer        belongsToMany  Workout      (via trainer_workouts)
SportsType     hasMany     Trainer
TrainerStatus  hasMany     Trainer
```

Cross-module: `Trainer` ↔ `Workout` (Workouts module) via `trainer_workouts`, and
`Trainer` shares the `SportsType` taxonomy with `Workout`.

### 4.4 Controllers

**`TrainerController`** (`app/Http/Controllers/TrainerController.php`)

| Method | Responsibility |
|---|---|
| `index` | Filtered/paginated listing (`Trainer::filter()` scope: specialty, min experience, status, name search). Returns partial HTML for AJAX requests (`trainers._trainer_grid`). Also computes `totalTrainers` / `activeTrainers` stat cards. |
| `create` / `store` | Create form + persist, with image upload to `public` disk. |
| `show` | Full profile incl. eager-loaded `workouts.sportsType`, `workouts.workoutLevel`. |
| `edit` / `update` | `Gate::authorize('edit', $trainer)` on `edit()`. `update()` conditionally includes `trainer_status_id` in validated fields only if `Gate::allows('editStatus', $trainer)` — this is the fix for the status-tampering bug (non-managers cannot change status even via crafted requests). |
| `destroy` | `Gate::authorize('delete', $trainer)`; blocks deletion if `$trainer->workouts()->exists()`, redirecting to `trainers.show` with an error flash. |
| `updateStatus` | Dedicated quick-status endpoint used by the inline `<select>` on the show page; `Gate::authorize('editStatus', $trainer)`. |
| `specialties` / `createSpecialty` / `editSpecialties` / `deleteSpecialties` | CRUD over `SportsType`, gated by `SportsTypePolicy` (`viewAny`, `create`, `update`, `delete` — manager-only). |

### 4.5 Policy (`app/Policies/TrainerPolicy.php`)

| Ability | Rule |
|---|---|
| `view`, `edit` | any authenticated `employee` or `manager` |
| `delete`, `editStatus` | `manager` only |
| `editSpecialization` (on `SportsType`) | `manager` only |

`SportsTypePolicy` mirrors this: `viewAny` / `create` / `update` / `delete` all
manager-only.

### 4.6 Routes (prefix requires `department:trainers`)

| Method | URI | Name | Action |
|---|---|---|---|
| PATCH | `/trainers/{trainer}/status` | `trainers.updateStatus` | `TrainerController@updateStatus` |
| GET | `/trainers/specialties` | `trainers.specialties` | `TrainerController@specialties` |
| POST | `/trainers/specialties` | `trainers.createSpecialty` | `TrainerController@createSpecialty` |
| PUT | `/trainers/specialties/{specialty}` | `trainers.editSpecialties` | `TrainerController@editSpecialties` |
| DELETE | `/trainers/specialties/{specialty}` | `trainers.deleteSpecialties` | `TrainerController@deleteSpecialties` |
| GET/POST/PUT/DELETE... | `/trainers[...]` | `trainers.*` | `Route::resource('trainers', TrainerController::class)` → `index`, `create`, `store`, `show`, `edit`, `update`, `destroy` |

---

## 5. Module: Members

### 5.1 Models

| Model | File |
|---|---|
| `Member` | `app/Models/Member.php` |
| `MembershipType` | `app/Models/MembershipType.php` |
| `MemberStatus` | `app/Models/MemberStatus.php` |

### 5.2 Database Tables

**`members`**

| Column | Type | Constraints |
|---|---|---|
| `id` | bigint | PK |
| `first_name`, `father_name`, `last_name` | string | required |
| `email` | string | required (not unique-constrained at DB level here) |
| `birth_date` | date | required |
| `national_id` | string(11) | **unique** |
| `phone` | string | required |
| `photo` | string | nullable — path on `public` disk |
| `membership_duration` | integer | months |
| `membership_type_id` | FK → `membership_types.id` | required |
| `member_status_id` | FK → `member_statuses.id` | required |
| `timestamps` | — | |

**`membership_types`**: `id`, `name`, `timestamps`.
**`member_statuses`**: `id`, `name`, `timestamps`.

**`member_workout`** (pivot): `id`, `member_id` FK cascade, `workout_id` FK cascade,
`trainer_id` FK → `trainers.id` (nullable, `nullOnDelete`), `start_date` (date),
`timestamps`, **unique(`member_id`, `workout_id`)**.

### 5.3 Relationships

```
Member  belongsTo      MembershipType
Member  belongsTo      MemberStatus
Member  belongsToMany  Workout   (via member_workout, pivot: trainer_id, start_date)
```

Cross-module: the `member_workout` pivot links Members directly to Workouts, and
optionally records *which trainer* (from the Trainers module) is coaching that
member/workout pairing — this is the only table that touches three departments'
data at once (Members, Workouts, Trainers).

### 5.4 Controller

**`MemberController`** (`app/Http/Controllers/MemberController.php`)

| Method | Responsibility |
|---|---|
| `index` | Filters by `first_name`, `last_name`, `national_id`, `member_status_id`. Not paginated (uses `->get()`). |
| `create` / `store` | Validates `national_id` (11 digits, unique), `phone` (`09\d{8}`), age 18–70 via `birth_date` bounds; uploads `photo`; hardcodes new members to `member_status_id = 1`. |
| `edit` / `update` | Unique checks ignore current record id (`unique:members,email,{id}` style). |
| `destroy` | Deletes `photo` from `public` disk before deleting the record. |
| `show` | Eager-loads `membershipType`; computes expiry as `created_at->addMonths(membership_duration)` inline in the Blade view. |

### 5.5 Routes (prefix requires `department:members`)

> ⚠️ Unlike every other module, Members routes are **not** a resource controller and
> most are **unnamed** (called via raw `/members/...` URIs in views instead of
> `route()` helpers). This is inconsistent with the rest of the codebase and makes
> the routes harder to reference safely from Blade/JS.

| Method | URI | Name | Action |
|---|---|---|---|
| GET | `/members/create` | — | `MemberController@create` |
| POST | `/members` | — | `MemberController@store` |
| GET | `/members` | `members.index` | `MemberController@index` |
| DELETE | `/members/{id}` | — | `MemberController@destroy` |
| GET | `/members/{id}/edit` | — | `MemberController@edit` |
| PUT | `/members/{id}` | — | `MemberController@update` |
| GET | `/members/{id}` | — | `MemberController@show` |

---

## 6. Module: Branches

### 6.1 Models

| Model | File |
|---|---|
| `Branch` | `app/Models/Branch.php` |
| `Country` | `app/Models/Country.php` — shared with Warehouses |

### 6.2 Database Tables

**`branches`**

| Column | Type | Constraints |
|---|---|---|
| `id` | bigint | PK |
| `name` | string | required |
| `location` | string | nullable |
| `phone` | string | nullable |
| `governorate` | string | nullable |
| `country_id` | FK → `countries.id` | required |
| `capacity` | integer | required |
| `brochure_path` | string | nullable |
| `timestamps` | — | |

**`countries`**: `id`, `name`, `timestamps`.

**`branch_warehouse`** (pivot): `id`, `branch_id` FK cascade, `warehouse_id` FK
cascade, `timestamps`.

**`branch_workout`** (pivot): `id`, `branch_id` FK cascade, `workout_id` FK cascade,
`timestamps`, **unique(`branch_id`, `workout_id`)**.

### 6.3 Relationships

```
Branch  belongsTo      Country
Branch  belongsToMany  Warehouse   (via branch_warehouse)
Branch  belongsToMany  Workout     (via branch_workout)
```

Cross-module: Branches connect to **Warehouses** (many-to-many, a branch can be
supplied by several warehouses and vice versa) and to **Workouts** (which sessions
are offered at which branch).

### 6.4 Controller

**`BranchController`** (`app/Http/Controllers/BranchController.php`)

| Method | Responsibility |
|---|---|
| `index` | Search by `name`/`location`, paginated (12/page), eager-loads `country`. |
| `create` / `store` | Uploads `brochure` to `public` disk under `brochures/`. |
| `show`, `edit`, `update` | Standard CRUD; `update` re-uploads brochure if a new file is present (no cleanup of the old file — potential orphaned-file issue). |
| `destroy` | Hard delete, no dependency checks (unlike Trainers/Workouts, which block deletion when related records exist). |

> Note: legacy/manual dashboard views (`branches.dashboard`, `data.entry`,
> `edit.data`, `details`) are static/simplified Blade pages not backed by
> `BranchController` — they're closures defined directly in `routes/web.php`.

### 6.5 Routes (prefix requires `department:branches`)

| Method | URI | Name | Action |
|---|---|---|---|
| GET | `/branches/dashboard` | `branches.dashboard` | closure → `branches.dashboard` view |
| GET | `/branches/data-entry` | `data.entry` | redirects to `branches.create` |
| GET | `/branches/edit-data` | `edit.data` | closure → `branches.edit-data` view |
| GET | `/branches/details` | `details` | closure → `branches.details` view |
| GET/POST/PUT/DELETE... | `/branches[...]` | `branches.*` | `Route::resource('branches', BranchController::class)` |

---

## 7. Module: Workouts

### 7.1 Models

| Model | File |
|---|---|
| `Workout` | `app/Models/Workout.php` |
| `WorkoutLevel` | `app/Models/WorkoutLevel.php` |
| `SportsType` | shared with Trainers |

### 7.2 Database Tables

**`workouts`**

| Column | Type | Constraints |
|---|---|---|
| `id` | bigint | PK |
| `name` | string(255) | **unique** |
| `description` | text | nullable |
| `price` | decimal(10,2) | required |
| `duration` | integer | required (minutes) |
| `sportstype_id` | FK → `sports_types.id` | `onDelete('cascade')` |
| `workoutlevel_id` | FK → `workout_levels.id` | `onDelete('cascade')` |
| `image` | string | nullable |
| `start_date` | datetime | required |
| `timestamps`, `deleted_at` | — | soft-deletable |

**`workout_levels`**: `id`, `level` enum(`beginner`,`intermediate`,`advanced`)
default `beginner`, `timestamps`.

Pivots owned by other modules but attached to `Workout`: `trainer_workouts`,
`branch_workout`, `member_workout` (see respective module sections above).

### 7.3 Relationships

```
Workout  belongsTo      SportsType     (sportstype_id)
Workout  belongsTo      WorkoutLevel   (workoutlevel_id)
Workout  belongsToMany  Trainer        (via trainer_workouts)
Workout  belongsToMany  Branch         (via branch_workout)
Workout  belongsToMany  Member         (via member_workout, pivot: trainer_id, start_date)
```

`Workout` is the most connected model in the system — it's the join point between
Trainers, Branches, and Members.

### 7.4 Controllers

**`WorkoutController`** (`app/Http/Controllers/WorkoutController.php`)

| Method | Responsibility |
|---|---|
| `index` | Paginated (9/page) listing, eager-loads `sportsType`, `workoutLevel`. |
| `create` / `store` | Uses `StoreWorkoutRequest` (Form Request, not shown in this excerpt); uploads `image`; syncs `branches[]` on create. |
| `show` | Eager-loads `sportsType`, `workoutLevel`, `branches`, `trainers`, `members`. |
| `edit` / `update` | Uses `UpdateWorkoutRequest`; deletes old image before storing a new one; re-syncs `branches`. |
| `destroy` | Blocks deletion if `branches()->exists()` **or** `trainers()->exists()`; deletes `image` from disk otherwise. |
| `searchPage` | Renders the advanced-search UI. |
| `search` | AJAX endpoint (`Workout::filter()` scope: `sports_type_id`, `workout_level_id`, `max_price`); returns rendered partial HTML + JSON envelope. |

**`WorkoutDashboardController`** (`app/Http/Controllers/WorkoutDashboardController.php`)
— computes `$stats` (`workouts_count`, `sports_types_count`, `workout_levels_count`,
`trainers_count`) for the `workouts.dashboard` Blade view.

### 7.5 Routes (prefix requires `department:workouts`)

| Method | URI | Name | Action |
|---|---|---|---|
| GET | `/workouts/dashboard` | `workouts.dashboard` | `WorkoutController@index` ⚠️ |
| GET | `/workouts/search` | `workouts.search.page` | `WorkoutController@searchPage` |
| GET | `/workouts/search/ajax` | `workouts.search` | `WorkoutController@search` |
| GET/POST/PUT/DELETE... | `/workouts[...]` | `workouts.*` | `Route::resource('workouts', WorkoutController::class)` |

> ⚠️ **Known issue:** `workouts.dashboard` is wired to `WorkoutController::index`
> (the plain paginated listing), **not** `WorkoutDashboardController::index`. The
> `resources/views/workouts/dashboard.blade.php` view expects a `$stats` array that
> only `WorkoutDashboardController::index` produces — hitting this route as
> currently configured will throw an undefined-variable error. Fix: point the route
> at `[WorkoutDashboardController::class, 'index']`.

---

## 8. Module: Warehouses

### 8.1 Models

| Model | File |
|---|---|
| `Warehouse` | `app/Models/Warehouse.php` |
| `Country` | shared with Branches |

### 8.2 Database Tables

**`warehouses`**

| Column | Type | Constraints |
|---|---|---|
| `id` | bigint | PK |
| `name` | string | required |
| `location` | string | required |
| `phone` | string | required |
| `country_id` | FK → `countries.id` | required |
| `governorate` | string | nullable |
| `capacity` | integer | nullable |
| `brochure` | string | nullable |
| `timestamps` | — | |

Shares the `branch_warehouse` pivot with the Branches module (see §6.2).

### 8.3 Relationships

```
Warehouse  belongsTo      Country
Warehouse  belongsToMany  Branch   (via branch_warehouse)
```

### 8.4 Controllers

**`WarehouseController`** (`app/Http/Controllers/WarehouseController.php`)

| Method | Responsibility |
|---|---|
| `index` | Filters: `search` (name), `governorate`, `capacity` (min), `country_id`; paginated (10/page); also computes summary stats (`totalWarehouses`, `totalCountries`, `totalBrochures`) and a hardcoded Syrian-governorate list for the filter dropdown. |
| `create` / `store` | Validates `name` unique, `governorate` against a fixed `in:` list, `brochure` (pdf/jpg/jpeg/png ≤5MB); syncs `branches[]`. |
| `edit` / `update` | Same validation with `Rule::unique(...)->ignore($warehouse->id)`; deletes the old brochure from the `public` disk before storing the new one; `sync()`s branches or `detach()`es if none submitted. |
| `downloadBrochure` | Streams the brochure file via `response()->download()`. |
| `destroy` | Deletes the brochure file, then the record. |

**`DashboardController`** (`app/Http/Controllers/DashboardController.php`) — powers
the `warehouse.dashboard` route: `totalWarehouses`, `totalCountries`,
`totalBrochures`, `latestWarehouses` (5 most recent, with `country`).

> ⚠️ **Dead/duplicate code:** `WarehouseDashboardController`
> (`app/Http/Controllers/WarehouseDashboardController.php`) implements a *richer*
> dashboard (governorate breakdown, capacity buckets, 5 latest warehouses with
> `branches`) targeting the `Warehouse.warehouse-dashboard.index` view — but **no
> route references it**. The active `warehouse.dashboard` route instead uses the
> simpler `DashboardController`, which targets a *different* view
> (`Warehouse.dashboard.index`). Either wire a route to
> `WarehouseDashboardController` or remove it.

### 8.5 Routes (prefix requires `department:warehouses`)

| Method | URI | Name | Action |
|---|---|---|---|
| GET | `/warehouses` | `warehouses.index` | `WarehouseController@index` |
| GET | `/warehouses/dashboard` | `warehouse.dashboard` | `DashboardController@index` |
| GET | `/warehouses/create` | `warehouses.create` | `WarehouseController@create` |
| POST | `/warehouses` | `warehouses.store` | `WarehouseController@store` |
| GET | `/warehouses/{warehouse}/edit` | `warehouses.edit` | `WarehouseController@edit` |
| PUT | `/warehouses/{warehouse}` | `warehouses.update` | `WarehouseController@update` |
| DELETE | `/warehouses/{warehouse}` | `warehouses.destroy` | `WarehouseController@destroy` |
| GET | `/warehouses/{warehouse}/download` | `warehouses.download` | `WarehouseController@downloadBrochure` |

---

## 9. Cross-Module Relationship Map

```
                        ┌───────────────┐
                        │  SportsType   │
                        └───┬───────┬───┘
                     hasMany│       │hasMany
                    ┌───────▼──┐ ┌──▼────────┐
                    │ Trainer  │ │  Workout  │
                    └────┬─────┘ └─┬───┬───┬─┘
       belongsToMany     │         │   │   │  belongsToMany
       (trainer_workouts)│    ┌────┘   │   └────┐ (member_workout)
                         └────►        │        ◄────┘
                              │  belongsToMany   │
                              │  (branch_workout)│
                         ┌────▼─────┐      ┌─────▼────┐
                         │  Branch  │      │  Member  │
                         └────┬─────┘      └──────────┘
              belongsToMany   │
              (branch_warehouse)
                         ┌────▼──────┐        ┌───────────┐
                         │ Warehouse │◄───────►│  Country  │
                         └───────────┘ belongsTo (Branch & Warehouse)
```

---

## 10. Setup & Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
# configure DB credentials in .env
php artisan migrate --seed
php artisan storage:link
npm install
npm run build   # or `npm run dev` for local development
```

> **Windows + Laravel Herd note:** `php artisan storage:link` can silently fail on
> Windows, leaving a plain `public/storage` directory instead of a symlink (uploaded
> images then 404). If images don't render after seeding, remove the directory and
> re-run the command:
> ```bash
> rmdir public\storage
> php artisan storage:link
> ```

Seeded credentials (`database/seeders/UserSeeder.php`): `{department}.manager@gym.com`
/ `{department}.employee@gym.com`, password `password`, for each of the five
departments.

---

## 11. Known Issues Summary

| # | Issue | Location |
|---|---|---|
| 1 | `workouts.dashboard` route calls `WorkoutController@index` instead of `WorkoutDashboardController@index`; the target view expects `$stats`. | `routes/web.php` |
| 2 | `WarehouseDashboardController` is fully implemented but unreferenced by any route (dead code); `warehouse.dashboard` uses the simpler `DashboardController` instead. | `app/Http/Controllers/WarehouseDashboardController.php` |
| 3 | Members module routes are unnamed and not resourceful, inconsistent with Trainers/Branches/Workouts. | `routes/web.php` |
| 4 | `App\Models\role` and `App\Models\department` use lowercase class names, violating naming conventions. | `app/Models/role.php`, `app/Models/department.php` |
| 5 | `BranchController::update`/`WarehouseController` re-upload logic sometimes leaves the previous file on disk (Branch brochure is never deleted on replace, unlike Warehouse's). | `app/Http/Controllers/BranchController.php` |
| 6 | `BranchController::destroy` performs a hard delete with no dependency checks, unlike `TrainerController::destroy` / `WorkoutController::destroy`. | `app/Http/Controllers/BranchController.php` |