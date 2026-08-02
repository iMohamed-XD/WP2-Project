<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    protected $fillable = ['name', 'duration'];
    
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
