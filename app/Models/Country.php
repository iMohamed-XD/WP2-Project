<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse;
use App\Models\Branch;
class Country extends Model
{
    protected $fillable = [
        'name',
    ];
    public function warehouses() {
        return $this->hasMany(Warehouse::class);
    }
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}