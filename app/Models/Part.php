<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = ['id', 'active', 'name'];

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'part_vehicle', 'part_id', 'vehicle_id');
    }
}
