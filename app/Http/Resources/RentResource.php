<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BikeResource;
use App\Bike;
use App\Http\Resources\UserResource;
use App\User;


class RentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'bike' => new BikeResource(Bike::find($this->bike_id)),
            'user' => $this->user_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'total_day' => $this->total_day,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            
        ];
    }
}
