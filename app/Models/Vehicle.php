<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'vehicle_id';

    public function parts()
    {
        return $this->belongsToMany(Part::class, 'part_vehicle', 'vehicle_id', 'part_id');
    }

    public function fullName()
    {
        return "$this->bike_producer $this->bike_model $this->year";
    }

}
