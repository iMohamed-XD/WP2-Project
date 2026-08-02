<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\warehouses;
use App\Models\Warehouse;
class Country extends Model
{
    protected $fillable = [
        'name',
    ];
     public function warehouses() {
        return $this->hasMany(Warehouse::class);
    }
}