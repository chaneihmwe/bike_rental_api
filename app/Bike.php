<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    //
    protected $fillable = ['brand_id', 'user_id', 'number', 'model', 'color', 'image', 'price', 'status', 'description'];
}
