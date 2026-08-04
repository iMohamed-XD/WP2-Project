<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class machine extends Model
{
    protected $fillable = [
        'name',
    ];
    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class);
    }
}
