<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
        $categories = Category::all();
        return view('backend.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('backend.category.create');
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
        ]);
        $category=new Category;
        $category->name =request('name');              
        $category->save();
        return redirect()->route('admin.category.index')->with('status','Category was successfully added!!');
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
        $category= Category::find($id);
        return view('backend.category.edit',compact('category'));
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
        ]);
        $category=Category::find($id);
        $category->name =request('name');         
        $category->save();
        return redirect()->route('admin.category.index')->with('status','Category was successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);         
        $category->delete();
        return redirect()->route('admin.category.index')->with('status','Category was successfully deleted!!');
    }

    public function getBrands($id)
    {
        $brands = Brand::where('category_id', $id)->get();
        return $brands;
    }
}
