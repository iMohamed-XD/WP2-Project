<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Branch;

class Warehouse extends Model
{
    protected $fillable = [
        'name',
        'location',
        'phone',
        'country_id',
        'governorate',   // أضف هذا
        'capacity',      // أضف هذا
        'brochure',
    ];


    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }
    public function machines()
    {
        return $this->belongsToMany(Machine::class);
    }
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'warehouse_workout')->withTimestamps();
    }
} 