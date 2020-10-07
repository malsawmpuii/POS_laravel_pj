<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Brand;
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
        $items =Item::all();
        return $items;
    }
    public function byCategory(Request $request)
    {
        $category_id = $request->category_id;
        $item = Item::where('category_id',$category_id)->get();
        return $item;
    }
    public function byBrand(Request $request)
    {
        $brand_id = $request->brand_id;
        $item = Item::where('brand_id',$brand_id)->get();
        return $item;
    }
}
