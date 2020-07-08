<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BrandResource;
use App\Brand;
use App\Http\Resources\UserResource;
use App\User;


class BikeResource extends JsonResource
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
            'number' => $this->number,
            'model' => $this->model,
            'color' => $this->color,
            'price' => $this->price,
            'image' => $this->image,
            'description' => $this->description,
            'status' => $this->status,
            'brand' => new BrandResource(Brand::find($this->brand_id)),
            'user' => new UserResource(User::find($this->user_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            
        ];
    }
}
