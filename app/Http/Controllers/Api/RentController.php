<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rent;
use App\Bike;
use App\Http\Resources\RentResource;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rents = Rent::all();
        $rents =  RentResource::collection($rents);
        return response()->json([
            'rents' => $rents,
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
            "bike_id" => 'required',
            "user_id" => 'required',
            "start_date" => 'required | min:6',
            "end_date" => 'required | min:3',
            "total_day" => 'required',
            "total_price" => 'required | min:3',
        ]);


        //store data 
        $rend = new Rent;
        $rend->bike_id = request('bike_id');
        $rend->user_id = request('user_id');
        $rend->start_date = request('start_date');
        $rend->end_date = request('end_date');
        $rend->total_day = request('total_day');
        $rend->total_price = request('total_price');
        $rend->save();

        $bike = Bike::find(request('bike_id'));
        $bike->status = 1;
        $bike->save();

        return response()->json([
            'rend'  =>  $rend,
            'message'   =>  'Successfully Rent Added!',
            'messageTwo'   =>  'Successfully Bike Status Changed'
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
        $bike = Bike::find($id);
        $bike->status = 0;
        $bike->save();

        return response()->json([
            'message'   =>  'Successfully Bike status updated!!'
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
        $rent = Rent::find($id);
        $rent->delete();
        
        return response()->json([
            'message'   =>  'Successfully Rent deleted!!'
        ],200);
    }
}
