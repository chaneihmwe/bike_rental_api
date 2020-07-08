<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bike;
use App\Category;
class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
        $bikes = Bike::all();
        return view('backend.bike.index',compact('bikes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('backend.bike.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*dd($request);*/
        $request->validate([              
            "brand_id"=> 'required',     
            "number"=> 'required|min:6',                 
            "model"=> 'required|min:3',                 
            "color"=> 'required|min:3',    
            /*"image"=>'required|image|mimes:jpeg,jpg,gif,png,svg|max:400000',  */
            "price"=> 'required|min:3',    
            "description"=> 'required|min:3',         
        ]);
        $image = $request->file('image');
         if($image){
            $name=uniqid().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('image'),$name);
            $path='image/'.$name;
            }else{
                 $path="";
        }

        $bike=new Bike;              
        $bike->brand_id =request('brand_id');  
        $bike->user_id =1;  
        $bike->number =request('number');            
        $bike->model =request('model');            
        $bike->color =request('color');            
        $bike->image =$path;            
        $bike->price =request('price');            
        $bike->description =request('description');            
        $bike->save();

        return redirect()->route('admin.bike.index')->with('status','Bike was successfully added!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facility  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facility  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $bike= Bike::find($id);
        return view('backend.bike.edit',compact('bike', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "brand_id"=> 'required',     
            "number"=> 'required|min:6',                 
            "model"=> 'required|min:3',                 
            "color"=> 'required|min:3',
            "price"=> 'required|min:3',    
            "description"=> 'required|min:3', 
        ]);
        $image = $request->file('image');
        if($image){
            $name=uniqid().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('image'),$name);
            $path='image/'.$name;
            }
        else
        {
             $path=request('old_image');
        }
        $bike=Bike::find($id);
        $bike->brand_id =request('brand_id');  
        $bike->user_id =1;  
        $bike->number =request('number');            
        $bike->model =request('model');            
        $bike->color =request('color');            
        $bike->image =$path;            
        $bike->price =request('price');            
        $bike->description =request('description');     
        $bike->save();
        return redirect()->route('admin.bike.index')->with('status','Bike was successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bike=Bike::find($id);         
        $bike->delete();
        return redirect()->route('admin.bike.index')->with('status','Car was successfully deleted!!');
    }
}
