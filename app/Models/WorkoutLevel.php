<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['level'])]
class WorkoutLevel extends Model
{
    public function workouts(): HasMany
    {
        return $this->hasMany(Workout::class, 'workoutlevel_id');
    }
}
