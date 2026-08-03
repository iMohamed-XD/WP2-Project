<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\WorkoutDashboardController;
use App\Http\Controllers\WorkoutController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Trainers done
Route::middleware(['auth', 'department:trainers'])->group(function () {
    Route::patch('/trainers/{trainer}/status', [TrainerController::class, 'updateStatus'])->name('trainers.updateStatus');
    Route::get('/trainers/specialties', [TrainerController::class, 'specialties'])->name('trainers.specialties');
    Route::post('/trainers/specialties', [TrainerController::class, 'createSpecialty'])->name('trainers.createSpecialty');
    Route::put('/trainers/specialties/{specialty}', [TrainerController::class, 'editSpecialties'])->name('trainers.editSpecialties');
    Route::delete('/trainers/specialties/{specialty}', [TrainerController::class, 'deleteSpecialties'])->name('trainers.deleteSpecialties');
    Route::resource('trainers', TrainerController::class);
});

//Members done
Route::middleware(['auth', 'department:members'])->group(function () {
    Route::get('/members/create', [MemberController::class, 'create']);
    Route::post('/members', [MemberController::class, 'store']);
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::delete('/members/{id}', [MemberController::class, 'destroy']);
    Route::get('/members/{id}/edit', [MemberController::class, 'edit']);
    Route::put('/members/{id}', [MemberController::class, 'update']);
    Route::get('/members/{id}', [MemberController::class, 'show']);
});

//Branches done
Route::middleware(['auth', 'department:branches'])->group(function () {
    Route::get('/branches/dashboard', fn() => view('branches.dashboard'))->name('branches.dashboard');
    Route::get('/branches/data-entry', fn() => redirect()->route('branches.create'))->name('data.entry');
    Route::get('/branches/edit-data', fn() => view('branches.edit-data'))->name('edit.data');
    Route::get('/branches/details', fn() => view('branches.details'))->name('details');
    Route::resource('branches', BranchController::class);
});

//Workouts
Route::middleware(['auth', 'department:workouts'])->group(function () {
    Route::get('/workouts/dashboard', [WorkoutController::class, 'index'])->name('workouts.dashboard');

    // مسار البحث المتقدم - يجب تسجيله قبل Route::resource لتجنب تعارض المسارات
    Route::get('/workouts/search', [WorkoutController::class, 'searchPage'])->name('workouts.search.page');
    Route::get('/workouts/search/ajax', [WorkoutController::class, 'search'])->name('workouts.search');

    // مسارات الحصص (Resource Controller)
    Route::resource('workouts', WorkoutController::class);
});

//Warehouses done
Route::middleware(['auth', 'department:warehouses'])->group(function () {
    Route::get('/warehouses', [WarehouseController::class, 'index'])
        ->name('warehouses.index');
    Route::get('/warehouses/dashboard', [DashboardController::class, 'index'])
        ->name('warehouse.dashboard');
    Route::get('/warehouses/create', [WarehouseController::class, 'create'])
        ->name('warehouses.create');
    Route::post('/warehouses', [WarehouseController::class, 'store'])
        ->name('warehouses.store');
    Route::get('/warehouses/{warehouse}/edit', [WarehouseController::class, 'edit'])
        ->name('warehouses.edit');
    Route::put('/warehouses/{warehouse}', [WarehouseController::class, 'update'])
        ->name('warehouses.update');
    Route::delete('/warehouses/{warehouse}', [WarehouseController::class, 'destroy'])
        ->name('warehouses.destroy');
    Route::get('/warehouses/{warehouse}/download', [WarehouseController::class, 'downloadBrochure'])
        ->name('warehouses.download');
});

//Login and Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');