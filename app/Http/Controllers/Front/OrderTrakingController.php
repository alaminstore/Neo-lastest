<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderbanner;
use Illuminate\Http\Request;

class OrderTrakingController extends Controller
{
    public function index()
    {
        $banner = Orderbanner::get();
        return view('front.order_traking.order_traking',compact('banner'));
    }
    public function details(Request $request)
    {
        $request->validate([
            'order_id'  => 'required ',
        ]);

        $banner = Orderbanner::get();
        // $status = Order::where('order_id', $request->order_id)->firstOrFail();
        $status = Order::Find($request->order_id);
        if($status){
            $order_status = $status->order_status;
            return view('front.order_traking.email-order-tracking',compact('order_status','status','banner'));
        }else{
            $notification = array('message' => 'Please Enter the correct Order ID', 'alert-type'=> 'error');
            return redirect()->back()->with($notification);
        }

    }
}