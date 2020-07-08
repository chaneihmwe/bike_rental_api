<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //
    protected $fillable = ['brand_id', 'user_id', 'car_no', 'model', 'capacity', 'color', 'image', 'status', 'description'];
}
