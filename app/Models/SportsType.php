<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['type'])]
class SportsType extends Model
{
    public function trainers()
    {
        return $this->hasMany(Trainer::class);
    }
}
