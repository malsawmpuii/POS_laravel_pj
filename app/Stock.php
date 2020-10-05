<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
    'item_id','perprice','quantity','in_date'

  ];

  public function item()
      {
        return $this->belongsTo('App\Item');
      }
}
