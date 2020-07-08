<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Brand::all();
        $categories =  BrandResource::collection($categories);
        return response()->json([
            'categories' => $categories,
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
            "name" => "required|min:3|max:20",
            "category_id" => "required",
        ]);
        $brand = Brand::create([
            "name" => request('name') ,
            "category_id" => request('category_id') ,
        ]);

        $brand = new BrandResource($brand);

        return response()->json([
            'brand'  =>  $brand,
            'message'   =>  'Successfully Brand Added!'
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
        //
        //echo "$request";die();
        $request->validate([
            "name" => "required|min:3|max:255",
            "category_id" => "required",
        ]);
        $brand= Brand::find($id);
        $brand->name=$request->name;
        $brand->category_id=$request->category_id;
        $brand->save();

        return response()->json([
            'message'   =>  'Successfully Brand updated!!'
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
        $brand = Brand::find($id);
        $brand->delete();

        return response()->json([
            'message'   =>  'Successfully Brand deleted!!'
        ],200);
    }
}
