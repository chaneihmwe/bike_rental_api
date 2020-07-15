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
        $owners = Category::all();
        return view('backend.bike.create', compact('categories','owners'));
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

    /*
    eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMGViZjhhNzNmMjc0NGJkNGExMTMzMDQ0OTRiMDZmNGYxNGNiY2M4OGFiMTIzOWY2NDE3NTA4NjZlM2U3MTEzYTMwOTVkY2YwNzJhNDdlZWMiLCJpYXQiOjE1OTQ1NDY5OTYsIm5iZiI6MTU5NDU0Njk5NiwiZXhwIjoxNjI2MDgyOTk2LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.nynREC8jDNHDcTvgkpXjRau2bIQ_vrFgSwZ2a1E6OalsSuQFociiO6kAbVyDQdlhGQHiXktmLflUN9LDR38In02dvEyPNBoHssOEQHnGmIiCki-JzLx8PwB8KmrVohzv4K9jv6aiZwRb5tW0vgiIGLsooNT0gSHk33ppel46Eyzk3cfGxtTBWnLsyVoAaxqh5i61Uvie5a41gb4wkH2KiqWGv8rt9pRwdN7Qe_Ip7zTW9HcT-DPa58UyhgJj_-_01732w3ZDbDiiistI-DDOu4E335NHft1pGIAdci4WaPK4sC-RohBSfqmUhFGRzD50mXf1TMZfJY3MfhDQ7y37o6m-zU2uAYHcruUYs9cCEKFO219bna4rFjQhpwyLZQv0ACQPSAoV1MNwuju73YIytD23EyZdTIlNgbmEHTpSvzHMB0gKQ-0AMixe6pKsK73ymudkgyT5FpYjbCWG5XA8RiKthvjMps0iQLUlkoI8s6Afwa_RdZnEuu-ICI_IwC1Cxrdg4q6d9jUnG90gL8-fzCuiDX-Dgm66MDM9DQ9bsv5ycSaowC7WHYCOHYGugicfpFLzsYOSSetlfAtDcC7usA0bS1WjRihb0VBt6QnxQVxuy9lZ0lori8uS0GHxGW9mvlJUpckOFwAVFHxjzzKMKs-uoegIjCPJUN9ptnnlu0Q*/