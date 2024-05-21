<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
	public $primaryKey = 'id';
	
	public function brand_detail(){
        return $this->belongsTo('App\Models\Brand','payment_brand','id');
    }
    
    public function card_details(){
        return $this->belongsTo('App\Models\CardDetail','customer_email','customer_email');
    }
}
