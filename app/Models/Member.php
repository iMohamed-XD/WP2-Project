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
    public function Workouts() {
        return $this->belongsToMany(Workout::class);
    }
    public function memberStatus()
    {
        return $this->belongsTo(MemberStatus::class);
    }
    
}
