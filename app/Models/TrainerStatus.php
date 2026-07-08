<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerStatus extends Model
{
    protected $fillable = ['status'];

    public function trainers()
    {
        return $this->hasMany(Trainer::class);
    }
}
