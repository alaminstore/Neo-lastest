<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        return view('backend.orders.orders', compact('orders'));
    }

    public function order($id)
    {

        $order          = Order::with('billing', 'user')
                                ->with('billing.district')
                                ->findOrFail($id);
        $order_items    = OrderItem::with('productInfo')
                                    ->with('productInfo.productWeight')
                                    ->with('productInfo.productItem')
                                    ->where('order_id', $id)->get();
    //    dd($order_items, $order);
        return view('backend.orders.order_details', compact('order', 'order_items'));
    }

    public  function orderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required | numeric',
            'order_status' => 'required | string | max:100',
        ]);

        // $status = Order::where('order_id', $request->order_id)->firstOrFail();

        // if($status->order_status == 'order confirmed'){
        //     $status->status = 1;
        //     $status->save();
        // }elseif($status->order_status == 'processing'){
        //     $status->status = 2;
        //     $status->save();
        // }elseif($status->order_status == 'order shipping'){
        //     $status->status = 3;
        //     $status->save();
        // }elseif($status->order_status == 'order delivered'){
        //     $status->status = 4;
        //     $status->save();
        // }

        DB::beginTransaction();
        try{
            $order = Order::where('order_id', $request->order_id)->select('order_status')->firstOrFail();
            if(($request->order_status == 'canceled') &&  ($order->order_status == 'order confirmed' ||  $order->order_status == 'processing'  || $order->order_status == 'order shipping' || $order->order_status == 'order delivered'))
            {
                $order_items     =  OrderItem::where('order_id', $request->order_id)->get();

                foreach ($order_items as $order_item)
                {
                    ProductInfo::where('product_info_id', $order_item->product_info_product_info_id)->firstOrFail()->increment('product_quantity', $order_item->quantity);
                }
            }


            if(($request->order_status == 'order confirmed' ||  $request->order_status == 'processing'  || $request->order_status == 'order shipping' || $request->order_status == 'order delivered') && ($order->order_status == 'canceled'))
            {
                $order_items     =  OrderItem::where('order_id', $request->order_id)->get();

                foreach ($order_items as $order_item)
                {
                    ProductInfo::where('product_info_id', $order_item->product_info_product_info_id)->firstOrFail()->decrement('product_quantity', $order_item->quantity);
                }

            }
            if($request->order_status == 'order confirmed' ||  $request->order_status == 'processing'  || $request->order_status == 'order shipping' || $request->order_status == 'order delivered' || $request->order_status == 'canceled')
            {
                $update_order_status = Order::where('order_id', $request->order_id)->update(['order_status'=> $request->order_status]);

                if($update_order_status)
                {
                   $order = Order::with('user')->where('order_id', $request->order_id)->select('order_status', 'user_id')->first();
                    if($request->order_status == 'order shipping' || $request->order_status == 'order delivered')
                    {
                         $sender_email = \Config::get('mail.from.address');
                         $email_info     = [
                                        'order_id'              => $request->order_id,
                                        'order_status'          => $order->order_status,
                                    ];
                        $user = $order->user;
                        Mail::send('emails.email_order_tracking', ['user'=> $user, 'email_info'=>$email_info ], function($message) use ($user, $sender_email)
                        {
                            $message->to($user->email);
                            $message->subject('Order Status - NeoBazaar');
                            $message->from($sender_email);

                        });
                    }

                    $notification = array('message' => 'Order status updated successfully', 'alert-type'=> 'success');
                    DB::commit();
                    return response()->json(['order_status'=>$order,'notification'=>$notification]);
                }
                else
                {
                    $notification = array('message' => 'Order Status not updated', 'alert-type'=> 'error');
                    return response()->json(['order_status' => $order,'notification' => $notification]);
                }

            }
            else
            {
                $notification = array('message' => 'Order status not match', 'alert-type'=> 'error');
                return response()->json(['order_status' => $order,'notification' => $notification]);
            }

        }catch(\Exception $e){
            DB::rollBack();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return response()->json(['order_status' => $request->order_status,'notification' => $notification]);
        }
    }

    public function orderPaymentStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required | numeric',
            'payment_status' => 'required | string | max: 100',
        ]);
        $update_order_status    = Order::where('order_id', $request->order_id)->update(['payment_status'=> $request->payment_status]);
        $payment_status         = Order::where('order_id', $request->order_id)->select('payment_status')->first();
        if($update_order_status)
        {
            $notification = array('message' => 'Payment Status Updated Successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }
        return response()->json(['payment_status'=>$payment_status,'notification'=>$notification]);
    }
}
