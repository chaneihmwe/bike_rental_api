<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        $users =  UserResource::collection($users);
        return response()->json([
            'users' => $users,
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
            "email" => "required|unique:users|email",
            "password" => "required|min:8",
        ]);
        $user = User::create([
            "name" => request('name') ,
            "email" => request('email') ,
            "password" => md5(request('password')) ,
        ]);

        $user = new UserResource($user);

        return response()->json([
            'brand'  =>  $user,
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
            "name" => "required|min:3|max:20",
            "email" => "required|email",
        ]);

        $user= User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        if ($request->new_password) {
            $password = md5($request->new_password);
        }else {
            $password = $request->old_password;
        }
        $user->password=$password;
        $user->save();

        return response()->json([
            'message'   =>  'Successfully User updated!!'
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
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'message'   =>  'Successfully Brand deleted!!'
        ],200);
    }
    public function checkAuth(Request $request)
    {
        //Check Auth
      $email = $request->email;
      $password = md5($request->password);
      $user = DB::table('users')->where([
                ['email', '=', $email],
                ['password', '=', $password],
            ])->get();

      if (count($user) >0) {
          return response()->json([
            'user' => $user,
            'message' => 'Login Successfully'
          ],200);
      } else {
          return response()->json([
            'user' => $user,
            'message' => 'Invaild Email Or Password'
          ],200);
      }
    }
}