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
        return $this->belongsToMany(Trainer::class, 'trainer_workouts');
    }

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'price' => 'decimal:2',
        ];
    }
}
