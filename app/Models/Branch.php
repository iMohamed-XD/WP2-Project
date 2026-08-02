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
    ];
    public function warehouses() {
        return $this->belongsToMany(Warehouse::class);
    }
}