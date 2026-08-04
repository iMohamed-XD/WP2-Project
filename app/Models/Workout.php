<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'description', 'price', 'duration', 'sportstype_id', 'workoutlevel_id', 'image', 'start_date'])]
class Workout extends Model
{
    use HasFactory;
    public function sportsType(): BelongsTo
    {
        return $this->belongsTo(SportsType::class, 'sportstype_id');
    }

    public function workoutLevel(): BelongsTo
    {
        return $this->belongsTo(WorkoutLevel::class, 'workoutlevel_id');
    }

    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(Trainer::class, 'trainer_workouts')->withTimestamps();
    }
    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_workout')->withTimestamps();
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_workout')->withPivot('trainer_id', 'start_date')->withTimestamps();
    }
    // public function machines()
    // {
    //     return $this->belongsToMany(Machine::class, 'machine_workout')->withTimestamps();
    // }
    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_workout')->withTimestamps();
    }

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'price' => 'decimal:2',
            'duration'   => 'integer',
        ];
    }
    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['sports_type_id'] ?? null, function ($q, $value) {
                $q->where('sportstype_id', $value);
            })
            ->when($filters['workout_level_id'] ?? null, function ($q, $value) {
                $q->where('workoutlevel_id', $value);
            })
            ->when($filters['max_price'] ?? null, function ($q, $value) {
                $q->where('price', '<=', $value);
            });
    }
}
