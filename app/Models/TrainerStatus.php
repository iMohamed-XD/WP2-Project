<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['status'])]
#[Hidden([])]
class TrainerStatus extends Model
{
    public function trainers(): HasMany
    {
        return $this->hasMany(Trainer::class);
    }
}
