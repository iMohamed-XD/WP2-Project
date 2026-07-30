<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'firstname',
    'lastname',
    'fathername',
    'phone',
    'address',
    'image',
    'gender',
    'sports_type_id',
    'birthplace',
    'birthdate',
    'years_of_experience',
    'SSN',
    'email',
    'hiring_date',
    'certification',
    'trainer_status_id',
])]
#[Hidden(['remember_token'])]
class Trainer extends Model
{
    use HasFactory, SoftDeletes;
    protected function casts(): array
    {
        return [
            'birthdate' => 'date',
            'hiring_date' => 'date',
            'email_verified_at' => 'datetime',
            'years_of_experience' => 'integer',
        ];
    }

    public function sportsType(): BelongsTo
    {
        return $this->belongsTo(SportsType::class);
    }

    public function trainerStatus(): BelongsTo
    {
        return $this->belongsTo(TrainerStatus::class);
    }

    public function scopeFilter($query, array $filters): void
    {
        $query->when($filters['specialty'] ?? null, function ($query, $specialty) {
            $query->where('sports_type_id', $specialty);
        })->when($filters['experience'] ?? null, function ($query, $experience) {
            $query->where('years_of_experience', '>=', $experience);
        })->when($filters['status'] ?? null, function ($query, $status) {
            $query->where('trainer_status_id', $status);
        })->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($sub) use ($search) {
                $sub->where('firstname', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%{$search}%"]);
            });
        });
    }
    protected function profilePictureUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image
                ? $this->publicStorageUrl($this->image)
                : asset('images/avatar-default.jpg')
        );
    }

    protected function publicStorageUrl(string $path): string
    {
        /** @var FilesystemAdapter $disk */
        $disk = Storage::disk('public');

        return $disk->url($path);
    }

    public function workouts(): BelongsToMany
    {
        return $this->belongsToMany(Workout::class, 'trainer_workouts');
    }
}
