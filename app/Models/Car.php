<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $fillable =[
        'maker_id',
        'car_model_id',
        'car_type_id',
        'fuel_type_id',
        'user_id',
        'city_id',
        'year',
        'price',
        'Vin',
        'mileage',
        'address',
        'phone',
        'description',
    ];

    //one car belongs to on user
    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function favorites(){
        return $this->belongsToMany(User::class , 'favorites');
    }

    public function carType(){
        return $this->belongsTo(CarType::class);
    }

    public function carFeatures(){
        return $this->hasOne(CarFeature::class);
    }

    public function model(){
        return $this->belongsTo(CarModel::class);
    }

        public function city(){
        return $this->belongsTo(City::class);
    }

        public function fuelType(){
        return $this->belongsTo(FuelType::class);
    }

        public function carImage(){
        return $this->belongsTo(CarImage::class);
    }

    public function PrimaryImage(){
        return $this->hasOne(CarImage::class)->oldestOfMany('position');
    }
        public function maker(){
        return $this->belongsTo(Maker::class);
    }


}
