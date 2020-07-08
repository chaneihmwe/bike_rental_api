<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Category;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
        $brands = Brand::all();
        return view('backend.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('backend.brand.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> 'required|min:3',                      
            "category_id"=> 'required',                      
        ]);

        $brand=new Brand;
        $brand->name =request('name');              
        $brand->category_id =request('category_id');              
        $brand->save();
        return redirect()->route('admin.brand.index')->with('status','Brand was successfully added!!');
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
        $brand= Brand::find($id);
        return view('backend.brand.edit',compact('brand', 'categories'));
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
            "name"=> 'required|min:3',
            "category_id"=> 'required',
        ]);
        $brand=Brand::find($id);
        $brand->name =request('name');         
        $brand->category_id =request('category_id');         
        $brand->save();
        return redirect()->route('admin.brand.index')->with('status','Brand was successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand=Brand::find($id);         
        $brand->delete();
        return redirect()->route('admin.brand.index')->with('status','Facility was successfully deleted!!');
    }
}
