<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
    'name','logo','phoneno','address'

  ];

  public function items()
  {
  	return $this->hasMany('App\Item');
  }

}
