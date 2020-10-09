<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Brand;
use App\Sale;

class SaleController extends Controller
{
    public function salepage($value='')
    {
        $categories=Category::all();
        $brands=Brand::all();
        return view('sale.sale_cart',compact('categories','brands'));
    }

    public function getallitem($value='')
    {
        $items =Item::with('stocks')->get();
        return $items;
    }
    public function byCategory(Request $request)
    {
        $category_id = $request->category_id;
        $item = Item::with('stocks')->where('category_id',$category_id)->get();
        return $item;
    }
    public function byBrand(Request $request)
    {
        $brand_id = $request->brand_id;
        $item = Item::with('stocks')->where('brand_id',$brand_id)->get();
        return $item;
    }
     public function sale(Request $request){

        $sales = json_decode($request->data);
        //dd($sales);
        $total = 0;

        foreach ($sales as $row) {

            $perprice = $row->perprice;
            $price = $perprice;

            $subtotal=$price*$row->quantity;
            $total += $subtotal++;
        }

        $sale = new Sale;
        $sale->sale_date = Carbon::now();
        $sale->voucherno = uniqid();
        $sale->total = $total;
        $sale->save();

        foreach ($sales as $value) {
            $sale->items()->attach($value->id,['qty'=>$value->quantity]);
        }

        return response()->json([
            'status' => 'Sale Successfully created!'
        ]);
        
    }


    public function salesuccess(){
        return view('sale.salesuccess');
    }
}
