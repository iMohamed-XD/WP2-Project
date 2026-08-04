<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse;
class Branch extends Model
{
     protected $fillable = [
        'name',
        'location',
        'phone',
        'governorate',
        'country_id',
        'capacity',
        'brochure_path',
    ];
    public function warehouses() {
        return $this->belongsToMany(Warehouse::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'branch_workout');
    }
    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'branch_trainer');
    }
}