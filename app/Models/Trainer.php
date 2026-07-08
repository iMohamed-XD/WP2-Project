<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = ['firstname',
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
        'trainer_status_id'];

    protected $hidden = ['remember_token'];

    protected $casts = [
        'birthdate' => 'date',
        'hiring_date' => 'date',
        'email_verified_at' => 'datetime',
        'years_of_experience' => 'integer',
    ];

    public function sportsType()
    {
        return $this->belongsTo(SportsType::class);
    }

    public function trainerStatus()
    {
        return $this->belongsTo(TrainerStatus::class);
    }
}
