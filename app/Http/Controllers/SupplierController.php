<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $suppliers=Supplier::all();
        return view('supplier.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
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
            "logo"=>"required",
            "phoneno"=>"required",
            "address"=>"required"
        ]);

        //if file include, upload
         if ($request->file()) {
             $fileName= time().'_'.$request->logo->getClientOriginalName();
             $filePath= $request->file('logo')->storeAs('supplier_photo',$fileName,'public');
             $filePath='/storage/'.$filePath;
         }
        //data store

         $supplier= new supplier;
         $supplier->name= $request->name;
         $supplier->logo= $filePath;
         $supplier->phoneno= $request->phoneno;
         $supplier->address= $request->address;
         $supplier->save();

        //return redirect
         return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('supplier.detail',compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //validation
        $request->validate([
            "name"=>"required",
            "logo"=>"required",
            "phoneno"=>"required",
            "address"=>"required"
        ]);

        //if file include, upload
         if ($request->file()) {
             $fileName= time().'_'.$request->logo->getClientOriginalName();
             $filePath= $request->file('logo')->storeAs('supplier_photo',$fileName,'public');
             $filePath='/storage/'.$filePath;
         }else{
            $filePath= $request->oldphoto;

         }
       
         //data store

         $supplier->name= $request->name;
         $supplier->logo= $filePath;
         $supplier->phoneno= $request->phoneno;
         $supplier->address= $request->address;
         $supplier->save();

        //return redirect
         return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index');
    }
}
