<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Category;
class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
        $cars = Car::all();
        return view('backend.car.index',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('backend.car.create', compact('categories'));
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
            "category_id"=> 'required',     
            "car_no"=> 'required|min:6',                 
            "model"=> 'required|min:3',                 
            "capacity"=> 'required|min:1',                 
            "color"=> 'required|min:3',    
            /*"image"=>'required|image|mimes:jpeg,jpg,gif,png,svg|max:400000',  */  
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

        $bike=new Car;              
        $bike->category_id =request('category_id');  
        $bike->user_id =1;  
        $bike->car_no =request('car_no');            
        $bike->model =request('model');            
        $bike->capacity =request('capacity');            
        $bike->color =request('color');            
        $bike->image =$path;          
        $bike->description =request('description');            
        $bike->save();

        return redirect()->route('admin.car.index')->with('status','Car was successfully added!!');
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
        $car= Car::find($id);
        return view('backend.car.edit',compact('car', 'categories'));
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
            "category_id"=> 'required',     
            "car_no"=> 'required|min:6',                 
            "model"=> 'required|min:3',                 
            "capacity"=> 'required|min:1',                 
            "color"=> 'required|min:3',
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

        $car=Car::find($id);
        $car->category_id =request('category_id');  
        $car->user_id =1;  
        $car->car_no =request('car_no');            
        $car->model =request('model');            
        $car->capacity =request('capacity');            
        $car->color =request('color');            
        $car->image =$path;          
        $car->description =request('description');    
        $car->save();
        return redirect()->route('admin.car.index')->with('status','Car was successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car=Car::find($id);         
        $car->delete();
        return redirect()->route('admin.car.index')->with('status','Car was successfully deleted!!');
    }
}
