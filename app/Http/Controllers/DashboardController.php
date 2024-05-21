<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\UserPackage;
use App\Models\Brand;
use App\Models\Packages;
use Illuminate\Support\Facades\Crypt;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::orderBy("id" , "desc")->get();
        return view('dashboard.billing')->with(compact('orders'));
    }
    public function billing()
    {
        $orders = Order::orderBy("id" , "desc")->where('is_deleted' , 0)->get();
        return view('dashboard.billing')->with(compact('orders'));
    } 

    public function order()
    {
        $orders = Order::all();
        return view('dashboard.order')->with(compact('orders'));
    }

    public function order_delete($id){
        try {
            //$decrypted = Crypt::decryptString($id);
            $order = Order::where("order_number" , $id)->first();
            if($order->is_paid == 1){
                return redirect($order->receipt_url)->with('success','Order Completed');
            }else{
                $order->is_active = 0;
                $order->is_deleted = 1;
                $order->save();
                return redirect()->back()->with('success',"Record has been deleted");
            }
        } catch (DecryptException $e) {
            dd($e);
        }
    }
     public function create_order()
    {
        
        $packages = Packages::where('is_active' , 1)->where('is_deleted' , 0)->get();
        $brands = Brand::where('is_active' , 1)->where('is_deleted' , 0)->get();
        return view('dashboard.create_order')->with(compact('packages','brands'));
    }
     public function submit_order(Request $request)
    {
        try {
            $order = New Order();
            $rand = time().rand(0,1000);
            $order->order_id = $rand;
            $brand = Brand::find($request->brand);
            $order->order_number = strtoupper(substr($brand->name,0,3)) . "-" .$order->order_id;
            $order->payment_brand = $brand->id; 
            $order->sale_amount = $request->amount;
            $order->sale_currency = $request->sale_currency;
            $order->payment_gateway = $request->payment_gateway;
            
            
            $order->description = $request->description;
            $order->sales_email = $request->sales_email;
            $order->customer_email = $request->customer_email;            
            
            $order->save();

            
            if(count($request->packages) > 0){
                foreach($request->packages as $key => $temp){
                    $userPackage = New UserPackage();
                    $userPackage->user_id = 1;
                    $userPackage->order_id = $order->id;
                    $userPackage->package_id = $temp;
                    $userPackage->save();
                }
            }

            return redirect('admin/billing'."#".$order->order_id)->with('success','Link has been created successfully');
        }
        catch (exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
        
    } 
   public function order_details($id)
    {
        $order=Order::find($id);
        $packages = Packages::where('is_active' , 1)->where('is_deleted' , 0)->get();
        $brands = Brand::where('is_active' , 1)->where('is_deleted' , 0)->get();
        return view('dashboard.order_details',compact('order','packages','brands'));
    }
    
    public function update_order(Request $request)
    {
        try {
            $order = Order::find($request->id);
            $rand = time().rand(0,1000);
            $order->order_id = $rand;
            $order->order_number = strtoupper(substr($request->brand,0,3)) . "-" .$order->order_id;
            $order->payment_brand = $request->brand; 
            $order->sale_amount = $request->amount;
            $order->sale_currency = $request->sale_currency;
            $order->payment_gateway = $request->payment_gateway;
            
            
            $order->description = $request->description;
            $order->sales_email = $request->sales_email;
            $order->customer_email = $request->customer_email;            
            
            $order->save();

            
            if(count($request->packages) > 0){
                
                $old_package = UserPackage::where("order_id" , $request->id)->get();
                foreach($old_package as $old_pack){
                    $old_pack->delete();
                }
                
                foreach($request->packages as $key => $temp){
                    $userPackage = New UserPackage();
                    $userPackage->user_id = 1;
                    $userPackage->order_id = $order->id;
                    $userPackage->package_id = $temp;
                    $userPackage->save();
                }
            }

            return redirect('admin/billing'."#".$order->order_id)->with('success','Link has been updated successfully');
        }
        catch (exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
        
    } 
    
    public function profile()
    {
        return view('dashboard.profile');
    } 
    public function rtl()
    {
        return view('dashboard.rtl');
    } 
    public function sign_in()
    {
        return view('dashboard.sign_in');
    } 
    public function sign_up()
    {
        return view('dashboard.sign_up');
    } 
    public function tables()
    {
        return view('dashboard.tables');
    } 
    public function virtual_reality()
    {
        return view('dashboard.virtual_reality');
    }

    
}
