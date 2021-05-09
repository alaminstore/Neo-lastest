<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BillingAddress;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\District;
use App\Models\NewsletterContent;
use App\Models\NewsletterSubscription;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductAttribute;
use App\Models\ProductInfo;
use App\Models\User;
use function compact;
use DB;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function number_format;
use function redirect;
use function session;
use function substr_replace;

class SslCommerzPaymentController extends Controller
{

    public function checkout()
    {
        $dateToday = (new \DateTime('now'))->modify('+30 day')->format('Y-m-d H:m:s');

        $discount_aligable = User::where('user_id', Auth::user()->user_id)
            ->where('newsletter_subscribed', 1)
            ->where('newsletter_discount_available', 1)
            ->where('newsletter_subscribed_at', '<',$dateToday)
            ->first();
        $percent = 0;
        if($discount_aligable)
        {
            $newsLetter = NewsletterSubscription::where('email',Auth::user()->email)->first();
            if($newsLetter)
            {
                $newsLetterDiscount = NewsletterContent::first();
                if($newsLetterDiscount->discount_amount > 1)
                {
                    $percent = Cart::total() ?  ( (Cart::total() * $newsLetterDiscount->discount_amount)/100) : 0;
                }

            }
            session()->put('newsletter_discount', number_format($percent, 2));

        }
        else
        {
            session()->forget(['newsletter_discount']);
        }

        $address = Address::with('district')
                            ->where('user_id', Auth::user()->user_id)
                            ->OrderBy('address_id', 'desc')
                            ->first();
        $districts = District::orderBy('name', 'asc')->get();
        return view('front.checkout.checkout', compact('address','districts'));
    }

    public function exampleEasyCheckout()
    {
        return redirect(url('/'));
    }

    public function exampleHostedCheckout()
    {
        return redirect(url('/'));
    }

    public function index(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name'            => 'required | string | max:200',
            'phone'            => 'required|min:11|numeric',
            'house_and_street'=> 'required',
            'country'         => 'required',
            'district'        => 'required',
            'city'            => 'required',
            'zip_code'        => 'required',
            'payment_method'  => 'required',
        ]);

        if(!Cart::count())
        {
            $notification = array('message' => 'Your Cart is empty!', 'alert-type'=> 'error');
            return redirect()->route('checkout')->with($notification);
        }

        foreach (Cart::content() as $cart)
        {

            $stock_quantity_check = ProductInfo::where('product_info_id', $cart->id)
                                                ->where('product_quantity', '<', $cart->qty)
                                                ->first();
            if($stock_quantity_check)
            {
                $notification = array('message' => 'Product has no Enough quantity. '.$cart->name, 'alert-type'=> 'error');
                return redirect()->route('cart')->with($notification);
            }
        }

        $cartTotal = Cart::total() != 0 ? str_replace(',', '', Cart::total()) - (session()->exists('newsletter_discount') ? session()->get('newsletter_discount') : 0) : 0;
        if($request->payment_method == 2 && $cartTotal < 10)
        {
            $notification = array('message' => 'You cant not pay less than 10 sslcommerz', 'alert-type'=> 'error');
            return redirect()->route('checkout')->with($notification);
        }

        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $cartTotal; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name']          = $request->input('name');
        $post_data['cus_email']         = Auth::user()->email;
        $post_data['cus_add1']          = $request->input('payment_method');
        $post_data['cus_add2']          = "";
        $post_data['cus_city']          = $request->city;
        $post_data['cus_postcode']      = $request->input('zip_code');
        $post_data['cus_country']       = $request->input( 'country');
        $post_data['cus_phone']         = Auth::user()->mobile_no;
//        $post_data['cus_fax']         = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        $payment_method = '';

        if($request->payment_method == 'cash_on_delivery')
        {
            $payment_method = 'Cash On Delivery';
        }
        elseif ($request->payment_method == 'ssl_commerz')
        {
            $payment_method = 'Ssl Commerz';
        }
        else
        {
            $notification = array('message' => 'please select correnct payment method!', 'alert-type'=> 'error');
            return redirect()->route('checkout')->with($notification);
        }

        DB::beginTransaction();
        try{

            if(session()->exists('newsletter_discount'))
            {
                if(session()->get('newsletter_discount') > 0)
                {
                    Auth::user()->update(['newsletter_discount_available' => 0]);
                }
            }


            $user_id           = Auth::user()->user_id;

            $billing                   = new BillingAddress;
            $billing->user_id          = $user_id;
            $billing->name             = $request->name;
            $billing->phone             = $request->phone;
            $billing->company_name     = $request->company;
            $billing->country          = $request->country;
            $billing->district_id      = $request->district;
            $billing->city             = $request->city;
            $billing->zip_code         = $request->zip_code;
            $billing->house_and_street = $request->house_and_street;

            $billing->save();

            $order                      = new Order;
            $order->user_id             = $user_id;
            $order->quantity            = Cart::count();
            $order->subtotal            = (Cart::subtotal() != 0 ? str_replace(',', '', Cart::subtotal()) : 0);
            $order->total               = (Cart::subtotal() != 0 ? str_replace(',', '', Cart::subtotal()) : 0) - (session()->exists('newsletter_discount') ? session()->get('newsletter_discount') : 0);
            $order->order_status        = 'order confirmed';
            $order->payment_status      = 'Pending';
            $order->payment_method      = $payment_method;
            $order->customer_note       = $request->note;
            $order->newsletter_subscription_discount       = (session()->exists('newsletter_discount') ? session()->get('newsletter_discount') : 0);
            $order->billing_address_billing_address_id   = $billing->billing_address_id;
            $order->save();

            foreach (Cart::content() as $cart)
            {
                $order_details                                  = new OrderItem;
                $order_details->order_id                        = $order->order_id;
                $order_details->product_info_product_info_id    = $cart->id;
                $order_details->quantity                        = $cart->qty;
                $order_details->unit_price                      = $cart->price;
                $order_details->total_price                     = $cart->price * $cart->qty;
                if($cart->options->discount_id){
                    $order_details->discount_id                     = $cart->options->discount_id;
                }
                $order_details->save();
                $stock_quantity_check = ProductInfo::where('product_info_id', $cart->id)->where('product_quantity', '<', $cart->qty)->first();
                if($stock_quantity_check)
                {
                    $notification = array('message' => 'Product has no Enough quantity. '.$cart->name, 'alert-type'=> 'error');
                    return redirect()->route('cart')->with($notification);
                }
                else
                {

                    ProductInfo::where('product_info_id',$cart->id)
                                ->first()
                                ->decrement('product_quantity', $cart->qty);
                }
            }

            $update_product = DB::table('ssl_payments')
                ->where('transaction_id', $post_data['tran_id'])
                ->updateOrInsert([
                    'order_id'          => $order->order_id,
                    'name'              => $post_data['cus_name'],
                    'email'             => $post_data['cus_email'],
                    'phone'             => $post_data['cus_phone'],
                    'amount'            => $post_data['total_amount'],
                    'status'            => 'Pending',
                    'address'           => $post_data['cus_add1'],
                    'transaction_id'    => $post_data['tran_id'],
                    'currency'          => $post_data['currency'],
                ]);

            $email_info     = [
                'order_id'              => $order->order_id,
                'order_status'          => $order->order_status,
            ];

            $user  = Auth::user();

            $sender_email = \Config::get('mail.from.address');

            Mail::send('emails.email_order_tracking', ['user'=> $user, 'email_info'=>$email_info ], function($message) use ($user, $sender_email)
            {
                $message->to($user->email);
                $message->subject('Order Status - NeoBazaar');
                $message->from($sender_email);

            });

            if($request->payment_method == 'cash_on_delivery')
            {
                Cart::destroy();

                DB::commit();
                $notification = array('message' => 'Your order placed successfully', 'alert-type'=> 'success');
                return redirect()->route('orders')->with($notification);
            }elseif($request->payment_method == 'ssl_commerz')
            {
                DB::commit();
                $sslc = new SslCommerzNotification();
                # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
                $payment_options = $sslc->makePayment($post_data, 'hosted');
                if (!is_array($payment_options)) {
                    $payment_options = array();
                }
            }
            else
            {
                $notification = array('message' => 'please select correnct payment method!', 'alert-type'=> 'error');
                return redirect()->route('checkout')->with($notification);
            }

        }catch(\Exception $e){
            dd($e);
            DB::rollBack();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('checkout')->with($notification);
        }
    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('ssl_payments')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $card_type = $request->input('card_type');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('ssl_payments')
                            ->where('transaction_id', $tran_id)
                            ->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */


                $update_product = DB::table('ssl_payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Complete','card_type' => $card_type]);
                Order::where('order_id', $order_details->order_id)->update(array('payment_status'=> 'Complete'));

                Cart::destroy();
                $notification = array('message' => 'Transaction is successfully Completed', 'alert-type'=> 'success');
                return redirect()->route('orders')->with($notification);
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('ssl_payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                Cart::destroy();
                $notification = array('message' => 'validation Fail, Please try again!', 'alert-type'=> 'error');
                return redirect()->route('orders')->with($notification);
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            $notification = array('message' => 'Transaction is successfully Completed', 'alert-type'=> 'success');
            return redirect()->route('orders')->with($notification);
        } else {
            #That means something wrong happened. You can redirect customer to your product page.

            $notification = array('message' => 'Invalid Transaction', 'alert-type'=> 'error');
            return redirect()->route('orders')->with($notification);
        }


    }

    public function fail(Request $request)
    {
        Cart::destroy();
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('ssl_payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'order_id')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('ssl_payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            Order::where('order_id', $order_details->order_id)->update(array('payment_status'=> 'Failed'));
            $notification = array('message' => 'Transaction is Failed', 'alert-type'=> 'error');
            return redirect()->route('orders')->with($notification);
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

            $notification = array('message' => 'Transaction is already successfully', 'alert-type'=> 'success');
            return redirect()->route('orders')->with($notification);
        } else {
            $notification = array('message' => 'Transaction is Invalid', 'alert-type'=> 'error');
            return redirect()->route('orders')->with($notification);
        }

    }

    public function cancel(Request $request)
    {
        Cart::destroy();

        $tran_id = $request->input('tran_id');

        $order_details = DB::table('ssl_payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'order_id')->first();

        if ($order_details->status == 'Pending') {

            $update_product = DB::table('ssl_payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            Order::where('order_id', $order_details->order_id)->update(array('payment_status'=> 'Canceled'));
            $notification = array('message' => 'Transaction is Cancel ', 'alert-type'=> 'error');
            return redirect()->route('orders')->with($notification);
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

            $notification = array('message' => 'Transaction is already Successfully', 'alert-type'=> 'success');
            return redirect()->route('orders')->with($notification);
        } else {

            $notification = array('message' => 'Transaction is Invalid', 'alert-type'=> 'error');
            return redirect()->route('orders')->with($notification);
        }
    }

    public function ipn(Request $request)
    {
        Cart::destroy();
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('ssl_payments')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount', 'order_id')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('ssl_payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Complete']);
                    Order::where('order_id', $order_details->order_id)->update(array('payment_status'=> 'Complete'));
                    $notification = array('message' => 'Transaction is successfully Completed', 'alert-type'=> 'success');
                    return redirect()->route('orders')->with($notification);
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('ssl_payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);
                    Order::where('order_id', $order_details->order_id)->update(array('payment_status'=> 'Failed'));
                    $notification = array('message' => 'Validation Fail', 'alert-type'=> 'error');
                    return redirect()->route('orders')->with($notification);
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.
                $notification = array('message' => 'Transaction is already Successfully Completed', 'alert-type'=> 'success');
                return redirect()->route('orders')->with($notification);
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                $notification = array('message' => 'Invalid Transaction', 'alert-type'=> 'error');
                return redirect()->route('orders')->with($notification);
            }
        } else {

            $notification = array('message' => 'Invalid Data', 'alert-type'=> 'success');
            return redirect()->route('orders')->with($notification);
        }
    }
}
