<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
     protected $fillable = [
    'user_id','profile','phoneno','address'

  ];
  public function user()
  {
  	return $this->belongsTo('App\User');
  }
}
