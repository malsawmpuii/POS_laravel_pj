<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Brand;
use App\Stock;

class MainController extends Controller
{
  public function index()
 {
   $items=Item::all();
   $categories=Category::all();
   $brands=Brand::all();
   $stocks=Stock::all();
   return view('sale.sale_cart',compact('items','categories','brands','stocks'));
   //return view('sale.index');
 }
 public function categorydetail($id)
 {
   $items=Item::where('category_id',$id)->get();
   $stocks=Stock::where('item_id',$id)->get();
   return view('/sale/category_detail',compact('items','stocks'));
 }

 public function branddetail($id)
 {
   $items=Item::where('brand_id',$id)->get();
   $stocks=Stock::where('item_id',$id)->get(); 
   return view('/sale/brand_detail',compact('items','stocks'));
 }  
}
