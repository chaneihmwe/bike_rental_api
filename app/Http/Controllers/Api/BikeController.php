<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bike;
use App\Http\Resources\BikeResource;
use Illuminate\Support\Facades\DB;

class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bikes = Bike::all();
        $bikes =  BikeResource::collection($bikes);
        return response()->json([
            'bikes' => $bikes,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            "brand_id" => 'required',
            "user_id" => 'required',
            "number" => 'required | min:6',
            "model" => 'required | min:3',
            "color" => 'required | min:3',
            "price" => 'required | min:3',
            "description" => 'required | min:3',
        ]);

        $image = $request->file('image');
        if($image){
            $name=uniqid().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/image'),$name);
            $path='storage/image/'.$name;
        }
        else{
            $path = null;
        }

        //store data 
        $bike = new Bike;
        $bike->brand_id = request('brand_id');
        $bike->user_id = request('user_id');
        $bike->number = request('number');
        $bike->model = request('model');
        $bike->color = request('color');
        $bike->price = request('price');
        $bike->description = request('description');
        $bike->image = $path;
        $bike->save();

        return response()->json([
            'bike'  =>  $bike,
            'message'   =>  'Successfully Bike Added!'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "brand_id" => 'required',
            "user_id" => 'required',
            "number" => 'required | min:6',
            "model" => 'required | min:3',
            "color" => 'required | min:3',
            "price" => 'required | min:3',
            "description" => 'required | min:3',
        ]);

        $image = $request->file('image');
        if($image){
            $name=uniqid().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/image'),$name);
            $path='storage/image/'.$name;
        }
        else{
            $path = request('old_image');
        }

        $bike = Bike::find($id);
        $bike->brand_id = request('brand_id');
        $bike->user_id = request('user_id');
        $bike->number = request('number');
        $bike->model = request('model');
        $bike->color = request('color');
        $bike->price = request('price');
        $bike->description = request('description');
        $bike->image = $path;
        $bike->save();

        return response()->json([
            'message'   =>  'Successfully Bike updated!!'
        ],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $bike = Bike::find($id);
        $bike->delete();
        
        return response()->json([
            'message'   =>  'Successfully Bike deleted!!'
        ],200);
    }

    public function getBikeByCategory(Request $request)
    {
      $category_id = $request->category_id;
      //return $city_keyword;
      $bikes = DB::table('bikes')
      ->join('brands', 'brands.id', '=', 'bikes.brand_id')
      ->join('categories', 'categories.id', '=', 'brands.category_id')
      ->select('bikes.*')
      ->where('categories.id','=', $category_id)
      ->get();
      $bikes =  BikeResource::collection($bikes);
      return response()->json([
        'bikes' => $bikes,
      ],200);
    }
}
