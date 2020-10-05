<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::all();
        return view('brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
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
             $filePath= $request->file('photo')->storeAs('brand_photo',$fileName,'public');
             $filePath='storage/'.$filePath;
         }
        //data store

         $brand= new Brand;
         $brand->name= $request->name;
         $brand->photo= $filePath;
         $brand->save();

        //return redirect
         return redirect()->route('brand.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('brand.detail',compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //validation
        $request->validate([
            "name"=>"required",
            "photo"=>"required"
        ]);
        
        //if file include, upload
         if ($request->file()) {
             $fileName= time().'_'.$request->photo->getClientOriginalName();
             $filePath= $request->file('photo')->storeAs('brand_photo',$fileName,'public');
             $filePath='/storage/'.$filePath;
         }else{
            $filePath= $request->oldphoto;

         }
        //data store
         $brand->name= $request->name;
         $brand->photo= $filePath;
         $brand->save();

        //return redirect
         return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brand.index');
    }
}
