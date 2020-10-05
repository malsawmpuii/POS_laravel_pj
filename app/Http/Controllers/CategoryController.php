<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            "name"=>"required",
            "photo"=>"required"
        ]);

        //if file include, upload
         if ($request->file()) {
             $fileName= time().'_'.$request->photo->getClientOriginalName();
             $filePath= $request->file('photo')->storeAs('category_photo',$fileName,'public');
             $filePath='/storage/'.$filePath;
         }
        //data store

         $category= new Category;
         $category->name= $request->name;
         $category->photo= $filePath;
         $category->save();

        //return redirect
         return redirect()->route('category.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.detail',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //validation
        $request->validate([
            "name"=>"required",
            "photo"=>"required"
        ]);

        //if file include, upload
         if ($request->file()) {
             $fileName= time().'_'.$request->photo->getClientOriginalName();
             $filePath= $request->file('photo')->storeAs('category_photo',$fileName,'public');
             $filePath='/storage/'.$filePath;
         }else{
            $filePath= $request->oldphoto;

         }
        //data store

         $category->name= $request->name;
         $category->photo= $filePath;
         $category->save();

        //return redirect
         return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }
}
