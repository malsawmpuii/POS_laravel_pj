<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Supplier;
use App\Stock;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers=Supplier::all();
        $categories=Category::all();
        $brands=Brand::all();
        $items=Item::all();
        $stocks=Stock::all();
        return view('item.index',compact('items','categories','brands','suppliers','stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers=Supplier::all();
        $categories=Category::all();
        $brands=Brand::all();
        $stocks=Stock::all();
        return view('item.create',compact('suppliers','categories','brands','stocks'));
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
            "photo"=>"required",
            "perprice"=>"required",
            "quantity"=>"required",
            "date"=>"required"

        ]);

        //if file include, upload
         if ($request->file()) {
             $fileName= time().'_'.$request->photo->getClientOriginalName();
             $filePath= $request->file('photo')->storeAs('item_photo',$fileName,'public');
             $filePath='/storage/'.$filePath;
         }          
         
         //data store
         $codeno = "GEGE-".rand(11111,99999);

         $item= new Item;
         $item->codeno=$codeno;
         $item->name=$request->name;
         $item->photo= $filePath;
         $item->supplier_id= $request->supplier;
         $item->category_id= $request->category;
         $item->brand_id= $request->brand;
         $item->save();

         $stock = new Stock;
         $stock->item_id =$item->id;
         $stock->perprice=$request->perprice;
         $stock->quantity=$request->quantity;
         $stock->in_date=$request->date;

         $stock->save();

        //return redirect
         return redirect()->route('item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $suppliers=Supplier::all();
        $categories=Category::all();
        $brands=Brand::all();
        $stocks=Stock::all();
        return view('item.detail',compact('suppliers','categories','categories','item','stocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $suppliers=Supplier::all();
        $categories=Category::all();
        $brands=Brand::all();
        $stock=Stock::all();
        return view('item.edit',compact('suppliers','categories','brands','item','stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //validation
        $request->validate([
            "name"=>"required",
            "photo"=>"sometimes"
        ]);

        //if file include, upload
         if ($request->file()) {
             $fileName= time().'_'.$request->photo->getClientOriginalName();
             $filePath= $request->file('photo')->storeAs('item_photo',$fileName,'public');
             $filePath='/storage/'.$filePath;
         }else{
            $filePath= $request->oldphoto;
        } 

        //data store

         $item->name=$request->name;
         $item->photo= $filePath;
         $item->supplier_id= $request->supplier;
         $item->category_id= $request->category;
         $item->brand_id= $request->brand;

         $item->save();
                
         /*$stock = $item->stock;
         $stock->item_id =$item->id;
         $stock->perprice=$request->perprice;
         $stock->quantity=$request->quantity;
         $stock->in_date=$request->date;

         $stock->save();
*/
        
        //return redirect
         return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        $item->stock->delete();
        return redirect()->route('item.index');


    }
}
