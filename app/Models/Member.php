<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'first_name', 'father_name', 'last_name', 'email', 'birth_date', 
        'national_id', 'phone', 'photo', 'membership_duration', 
        'membership_type_id', 'member_status_id'
    ];
    public function membershipType()
    {
        return $this->belongsTo(MembershipType::class);
    }
    public function memberStatus()
    {
        return $this->belongsTo(MemberStatus::class);
    }
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'member_workout')
                    ->withPivot('trainer_id', 'start_date')
                    ->withTimestamps();
    }
}
