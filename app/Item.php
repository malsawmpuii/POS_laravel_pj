<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    'codeno','name','photo','supplier_id','category_id','brand_id'

  ];

  public function supplier()
  {
  	return $this->belongsTo('App\Supplier');
  }

  public function category()
  {
  	return $this->belongsTo('App\Category');
  }
  
  public function brand()
  {
  	return $this->belongsTo('App\Brand');
  }

  public function stocks()
  {
    return $this->hasMany('App\Stock');
  }

  public function sales(){
      return $this->belongsToMany('App\Sale','sale_details','sale_id','item_id')
      ->withPivot('qty')
      ->withTimestamps();
    }
}
