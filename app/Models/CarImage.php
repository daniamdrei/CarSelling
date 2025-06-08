<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    public $fillable = [
        'image_path',
        'position',
    ];

    public function cars(){
     return $this->hasMany(Car::class);
    }
}
