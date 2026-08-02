<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse;
class Branch extends Model
{
     protected $fillable = [
        'name',
    ];
    public function warehouses() {
        return $this->belongsToMany(warehouse::class);
    }
}