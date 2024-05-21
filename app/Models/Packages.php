<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;
    protected $table = 'packages';
	public $primaryKey = 'id';
	
	public function user_package($order_id , $package_id)
    {
        $userpackage = UserPackage::where("order_id" , $order_id)->where("package_id" , $package_id)->first();
        if($userpackage){
            return true;
        }else{
            return false;
        }
    }
}
