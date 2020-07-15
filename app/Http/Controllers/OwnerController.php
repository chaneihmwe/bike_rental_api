<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\CustomerResource;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $owner =  OwnerResource::collection($owner);
        return response()->json([
            'owner' => $owner,
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
            "name"=> 'required|min:4',                      
            "email"=> 'required|min:5|unique:users',                      
            "passwrod"=> 'required|min:5',
        ]);

        $customer=new User;
        $customer->name =request('name');              
        $customer->email =request('email');              
        $customer->address =request('address');              
        $customer->role = 'customer';              
        $customer->save();

        $customer = new CustomerResource($customer);

        return response()->json([
            'customer'  =>  $customer,
            'message'   =>  'Successfully Customer Added!'
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
            "name"=> 'required|min:4',                      
            "phone_no"=> 'required|min:5',                      
            "address"=> 'required|min:5', 
        ]);
        
        $customer=User::find($id);
        $customer->name =request('name');              
        $customer->phone_no =request('phone_no');              
        $customer->address =request('address');        
        $customer->role ='customer';        
        $customer->save();

        return response()->json([
            'message'   =>  'Successfully Customer updated!!'
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
        $customer = User::find($id);
        $customer->delete();

        return response()->json([
            'message'   =>  'Successfully Customer deleted!!'
        ],200);
    }
}
