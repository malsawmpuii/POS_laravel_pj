<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
 	protected $fillable=[
	'voucherno','total','sale_date',
    ];

    public function items(){
    	return $this->belongsToMany('App\Item','sale_details','sale_id','item_id')
    	->withPivot('qty')
    	->withTimestamps();
    }
}