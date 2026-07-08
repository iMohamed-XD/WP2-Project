<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportsType extends Model
{
    protected $fillable = ['type'];

    public function trainers()
    {
        return $this->hasMany(Trainer::class);
    }
}
