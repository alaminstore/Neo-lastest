<?php

namespace App\Http\Controllers;

use App\Models\AboutUsBanner;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductReview;
use App\Models\Referral;
use App\Models\User;
use function count;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function number_format;
use function unlink;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('backend.dashboard.dashboard');
    }

    public function todayTotalOrderAmount()
    {
        return Order::whereDate('created_at', date('Y-m-d'))
            ->get()
            ->sum('order_total');
    }

    public function todayTotalOrderCount()
    {
        return Order::whereDate('created_at', date('Y-m-d'))
            ->get()
            ->count();
    }

    public function totalOrderAmount()
    {
        return Order::get()->sum('order_total');
    }

    public function totalOrderCount()
    {
        return Order::get()->count();
    }

    public function todayTotalOrderAmountComplete()
    {
        return Order::whereDate('created_at', date('Y-m-d'))
            ->where('order_status', 'completed')
            ->get()
            ->sum('order_total');
    }

    public function todayTotalOrderCountComplete()
    {
        return Order::whereDate('created_at', date('Y-m-d'))
            ->where('order_status', 'completed')
            ->get()
            ->count();
    }

    public function totalOrderAmountComplete()
    {
        return Order::where('order_status', 'completed')
            ->get()
            ->sum('order_total');
    }

    public function totalOrderCountComplete()
    {
        return Order::where('order_status', 'completed')
            ->get()
            ->count();
    }

    public function totalOrderAmountPending()
    {
        return Order::where('order_status', 'pending')
            ->get()
            ->sum('order_total');
    }

    public function totalOrderCountPending()
    {
        return Order::where('order_status', 'pending')
            ->get()
            ->count();
    }

    public function totalCustomer()
    {
        return User::where('role_id', 8)
            ->get()
            ->count();
    }

    public function todayTotalCustomer()
    {
        return User::where('role_id', 8)
            ->whereDate('created_at', date('Y-m-d'))
            ->get()
            ->count();
    }

    public function totalProduct()
    {
        return Product::where('flag', 1)->get()
            ->count();
    }

    public function todayTotalProduct()
    {
        return Product::where('flag', 1)
            ->whereDate('created_at', date('Y-m-d'))
            ->get()
            ->count();
    }

    public function todayPendingReview()
    {
        return ProductReview::where('reply_message', null)
            ->whereDate('created_at', date('Y-m-d'))
            ->get()
            ->count();
    }

    public function totalPendingReview()
    {
        return ProductReview::where('reply_message', null)
            ->get()
            ->count();
    }

    public function referral()
    {
        $referral = DB::table('referrals')
            ->select('id', 'referrer', 'user_id')
            ->get();
        return view('backend.admins.referral')->with('referral', $referral);
    }

    public function referral_details($mail)
    {
        $decrypted = \Crypt::decrypt($mail);
        $referrals = Referral::where('referrer', $decrypted)->get();
        $date = Carbon::today()->subDays(30);
        foreach ($referrals as $referral) {
            $orders = Order::where('user_id', $referral->user_id)
                ->where('created_at', '>=', $date)
                ->get();
            $user = User::where('email', '=', $decrypted)->get();
            // return $user;
            foreach ($orders as $order) {
                // $arr[] = $order->total;
                $arr[$order['user_id']][] = $order->total;
            }
        }

        $final = [];
        $total_sum = [];
        if (!empty($arr)) {
            foreach ($arr as $key => $ar) {
                $final[$key] = array_sum($ar);
                $total_sum[] = array_sum($ar);
            }
        }
        $keys = array_keys($final);
        // return $keys;
          $total_amount = array_sum($total_sum);
        return view('backend.admins.referral_details', compact('referrals', 'final', 'keys','total_amount','user'));
    }

    public function about_us_backend()
    {
        $sliders = AboutUsBanner::get();
        return view('backend.admins.about_us.about_us', compact('sliders'));
    }

    public function about_us_banner_store(Request $request)
    {
        $request->validate([
            'image' => 'required | mimes:png,jpeg,jpg',
        ]);

        $slider = new AboutUsBanner();
        if ($request->hasFile('image')) {
            $path = 'images/banners/';

            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $slider->image = $path . $imageName;
        }

        if ($slider->save()) {
            $notification = array('message' => 'Banner added successfully', 'alert-type' => 'success');
        } else {
            $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
        }

        return redirect()->route('admin.about_us_banner_store')->with($notification);

    }

    public function about_us_banner_edit($id){
        $banner  = AboutUsBanner::find($id);
        return response()->json($banner);
    }
//    public function about_us_banner_udpate(Request $request){
//
//        $request->validate([
//            'image' => 'nullable | mimes:png,jpeg,jpg',
//            'add_link' => 'nullable | string | max: 255',
//        ]);
//
//        $banner = AboutUsBanner::find($request->id);
//        if($request->hasFile('image'))
//        {
//            $path  = 'images/banners/';
//            @unlink($banner->image);
//            if (!is_dir($path))
//            {
//                mkdir($path, 0755, true);
//            }
//
//            $image              = $request->image;
//            $imageName          = rand(100,1000).$image->getClientOriginalName();
//
//            $image->move($path,$imageName);
//            $banner->image      = $path.$imageName;
//        }
//        $banner->add_link      = $request->add_link;
//        if($banner->save())
//        {
//            $notification = array('message' => 'Banner updated successfully', 'alert-type'=> 'success');
//        }
//        else
//        {
//            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
//        }
//
//        return redirect()->route('admin.about_us_banner_store')->with($notification);
//    }

    public function about_us_banner_destroy($id)
    {
        DB::beginTransaction();
        $about_banner = AboutUsBanner::findOrFail($id);
        $about_banner->delete();
        DB::commit();
        $notification = array('message' => 'Banner deleted successfully', 'alert-type' => 'success');
//        if ($about_banner->delete()) {
//            $notification = array('message' => 'Slider deleted successfully', 'alert-type' => 'success');
//        } else {
//            $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
//        }
        return redirect()->route('admin.about_us')->with($notification);
    }


}
