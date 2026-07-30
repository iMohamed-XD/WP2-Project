<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;

#[Fillable(['level'])]
class WorkoutLevel extends Model
{
    public function workout()
    {
        return $this->hasMany(Workout::class);
    }
}
