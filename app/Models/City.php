<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class City extends Model
{
    public $fillable = ['name' , 'state_id'];

    public function state(){
    return $this->belongsTo(State::class);
    }
    public function cars(){
        return $this->hasMany(Car::class);
    }
}
