<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
	public $primaryKey = 'id';

	//protected $casts = ['card_number' => 'encrypted:array']; 
	
	public function user_package($order_id , $package_id)
    {
        $userpackage = UserPackage::where("order_id" , $order_id)->where("package_id" , $package_id)->first();
        if($userpackage){
            return true;
        }else{
            return false;
        }
    }
    
    
    public function brand_detail()
    {
        return $this->belongsTo('App\Models\Brand', 'payment_brand', 'id');
    }
}
