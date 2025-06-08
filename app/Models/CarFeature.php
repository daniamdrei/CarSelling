<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarFeature extends Model
{
    protected $fillable=[
        'car_id',
        'rear_parking_sensors',
        'air_conditioning',
        'power_windows',
        'power_door_locks',
        'cruise_control',
        'bluetooth_connectivity',
        'gps_navigation',
        'heated_seats',
        'climate_control',
        'leather_seats',
    ];

    public function Car(){
        return $this->belongsTo(Car::class);
    }
}
