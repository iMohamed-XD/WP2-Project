<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'first_name',
    'father_name',
    'last_name',
    'birth_date',
    'membership_start_date',
    'national_id',
    'phone',
    'membership_type',
    'photo',
    'image',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class Member extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
}
