<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;
use App\Item;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::all();
        $items=Item::all();
        return view('stock.index',compact('stocks','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         /*$stock = new Stock;
         $stock->item_id =$item->id;
         $stock->perprice=$request->perprice;
         $stock->quantity=$request->quantity;
         $stock->in_date=$request->date;

         $stock->save();
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        $items=Item::all();
        return view('stock.detail',compact('stock','items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        return view('stock.edit',compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //validation
        $request->validate([
            "perprice"=>"required",
            "quantity"=>"required",
            "in_date"=>"required"

        ]);
        
        //data store
                
         $stock = $item->stock;
         $stock->item_id =$item->id;
         $stock->perprice=$request->perprice;
         $stock->quantity=$request->quantity;
         $stock->in_date=$request->date;

         $stock->save();

        
        //return redirect
         return redirect()->route('stock.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
     /*public function getitem(Request $request)
    {
        $codeno = $request->codeno;
        $item = Item::where('codeno',$codeno)->get();
        return $item;
    }*/

    public function getitem(Request $request)
    {
        $stock = $item->stock;
        $item->codeno = $request->codeno;
        $item = Item::find($codeno);
        return $item;
    }
}
