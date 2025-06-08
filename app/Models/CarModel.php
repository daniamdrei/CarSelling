<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    public $fillable = ['name' , 'maker_id'];

    public function cars(){
        return $this->hasMany(Car::class);
    }

    public function maker(){
        return $this->belongsTo(Maker::class);
    }
}
