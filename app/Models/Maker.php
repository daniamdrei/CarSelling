<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    public $fillable = ['name'];

    public function models(){
        return $this->hasMany(CarModel::class);
    }
    public function cars(){
        return $this->hasMany(Car::class);
    }
}
