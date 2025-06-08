<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    public $fillable = ['name'];

    public function cities(){
       return $this->hasMany(City::class);
    }


}
