<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    //
    protected $fillable = ['user_id', 'bike_id', 'start_date', 'end_date', 'total_day', 'total_date', 'total_price'];
}
