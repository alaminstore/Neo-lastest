<?php

namespace App\Http\Controllers\Front\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\District;
use App\Models\NewsletterSubscription;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\VarDumper\Cloner\Data;

class CustomerController extends Controller
{
    public function accountView()
    {
        if(Auth::check())
        {
            return redirect()->route('front');
        }
        return view('front.auth.login');
    }

    public function registerView()
    {
        if(Auth::check())
        {
            return redirect()->route('front');
        }
        return view('front.auth.register');
    }

    public function account(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $login = request()->input('email');

        $field = '';

        if(is_numeric($login))
        {
            $field = 'mobile_no';
        }

        if(filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        }
        request()->merge([$field => $login]);
        $credintials = array_merge($request->only($field, 'password'), ['role_id'=> 2, 'status'=> 1]);

        if(Auth::attempt($credintials,(request()->query('remember') == 'on') ? true : false))
        {
            if($request->page == 'checkout')
            {
                return redirect()->route('checkout');
            }
            return redirect()->route('dashboard');
        }

        $notification = array('message' => 'Email or Password is wrong', 'alert-type'=> 'error');

        if($request->page == 'checkout')
        {
            return redirect()->route('account','page=checkout')->with($notification);
        }

        return redirect()->route('account')->with($notification);

    }

    public function register(Request $request)
    {
        $request->validate([
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_number'     => ['required', 'string','min:11', 'max:11', 'unique:users,mobile_no'],
            'password'          => ['required', 'string', 'min:8','confirmed'],
        ]);

        DB::beginTransaction();
        try {
            $user =  User::create([
                'name'                  => $request->name,
                'email'                 => $request->email,
                'mobile_no'             => $request->mobile_number,
                'role_id'               => 2,
                'email_verify_token'    => Str::random(60),
                'password'              => Hash::make($request->password),
            ]);
            $newsletter = NewsletterSubscription::where('email', $request->email)->first();
            if($newsletter)
            {
                $user_newsletter          = User::where('email', $newsletter->email)->first();
                $user_newsletter->newsletter_subscribed = 1;
                $user_newsletter->newsletter_discount_available = 1;
                $user_newsletter->newsletter_subscribed_at = date('Y-m-d H:i:s');
                $user_newsletter->save();

            }

            $sender_email = Config::get('mail.from.address');
            Mail::send('emails.email_verify', ['user'=>$user], function($message) use ($user, $sender_email)
            {
                $message->to($user->email);
                $message->subject('verify Email');
                $message->from($sender_email);

            });

            $notification = array('message' => 'Please check your provided email for verify mail.', 'alert-type'=> 'success');
            DB::commit();
            return redirect()->route('notice')->with($notification);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            $notification = array('message' => 'Something went wrong', 'alert-type'=> 'error');
            return redirect()->route('account.register')->with($notification);
        }

    }

    protected function verify($email, $token)
    {

        $user = User::where('email', $email)->where('email_verify_token', $token)->first();
        if($user ? $user->status == 1 : '')
        {
            $notification = array(
                'message' => 'your email already verified.',
                'alert-type' => 'success'
            );
            return redirect(route('login'))->with($notification);
        }

        if($user)
        {
            $user_active = User::where('email', $email)->where('email_verify_token', $token)->update(['email_verify_token' => NULL,'email_verified_at' => date('Y-m-d H:i:s'), 'status'=> 1]);
            if($user_active)
            {
                $notification = array(
                    'message' => 'your email verified successfully complete, Please login',
                    'alert-type' => 'success'
                );
                return redirect(route('account'))->with($notification);
            }
        }
        else
        {
            $notification = array(
                'message' => 'Please provide valid information',
                'alert-type' => 'error'
            );
            return redirect(route('account'))->with($notification);
        }
    }

    public function getEmail()
    {
        return view('front.auth.reset_email');
    }

    public function postEmail(Request $request)
    {

        $request->validate([
            'email'     => ['required', 'string', 'email', 'max:255', 'exists:users'],
        ]);
        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('emails.email_password_reset',['token' => $token], function($message) use ($request) {
            $message->from(Config::get('mail.from.address'));
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });
        $notification = array('message' => 'We have e-mailed your password reset link!', 'alert-type'=> 'success');
        return redirect()->route('password.email')->with($notification);
    }

    public function getReset($token)
    {
        $email = DB::table('password_resets')
                    ->select('email')
                    ->where('token',$token)
                    ->orderBy('created_at', 'desc')
                    ->first();

        return view('front.auth.password_reset', ['token' => $token, 'email' => $email ? $email->email : '']);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email'         => 'required|email|exists:users',
            'token'         => 'required',
            'password'      => 'required|string|min:8|confirmed',

        ]);

        $updatePassword = DB::table('password_resets')
                            ->where('email', $request->email)
                            ->where('token', $request->token)
                            ->first();

        if(!$updatePassword)
        {
            $notification = array('message' => 'Invalid token!', 'alert-type'=> 'error');
            return back()->withInput()->with($notification);
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        $notification = array('message' => 'Your password has been changed!', 'alert-type'=> 'success');
        return redirect()->route('account')->with($notification);

    }

    public function dashboard()
    {
        if(!Auth::check())
        {
            return redirect()->route('front');
        }
//        $wishlists         = Wishlist::with('product')
//                                    ->where('user_id', Auth::user()->id)
//                                    ->paginate(10,['*'], 'other_page');
//
//        $orders            = Order::with('shipping')
//                                    ->where('user_id', Auth::user()->id)
//                                    ->orderBy('created_at','desc')
//                                    ->paginate(10);
//        $order_details     = OrderDetail::with('product')
//                                        ->join('orders', 'orders.id', 'order_details.order_id')
//                                        ->where('orders.user_id',Auth::user()->id)
//                                        ->select('order_details.*', 'orders.user_id')
//                                        ->get();

        return view('front.user.dashboard');
    }

    public function accrountInfoChange(Request $request)
    {
        $request->validate([
            'name' => 'required |string | max:150',
        ]);

        $user               = User::findOrFail(Auth::user()->user_id);
        $user->name         = $request->name;
        if($user->save())
        {
            $notification = array('message' => 'Update information successfully', 'alert-type'=> 'success');
            return redirect()->route('account.details')->with($notification);
        }
        $notification = array('message' => 'Something went Wrong!', 'alert-type'=> 'error');
        return redirect()->route('account.details')->with($notification);
    }

    public function accrountChangePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required | min:8 | max:150',
            'password' => 'required | string | min:8 | confirmed',

        ]);
        $user   = User::find(Auth::user()->user_id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            $notification = array('message' => 'Password updated successfully', 'alert-type'=> 'success');
            return redirect()->route('account.details')->with($notification);

        } else {
            $notification = array('message' => 'Password does not match', 'alert-type'=> 'error');
            return redirect()->route('account.details')->with($notification);
        }

    }

    public function orders()
    {
        $orders   = Order::with('billing','user')
                        ->where('user_id', Auth::user()->user_id)
                        ->orderBy('order_id', 'desc')
                        ->get();

        $order_id = $orders->map(function ($order){
            return $order->order_id;
        });

        $order_details    = OrderItem::with('productInfo')
                                    ->with('productInfo.productWeight')
                                    ->with('productInfo.productItem')
                                    ->whereIn('order_id', $order_id)
                                    ->get();
//        dd($order_details);
        return view('front.user.orders', compact('orders', 'order_details'));
    }

    public function address()
    {
        $address = Address::with('district')
                            ->where('user_id',Auth::user()->user_id)
                            ->first();
        $districts = District::orderBy('name', 'asc')->get();
        return view('front.user.address', compact('address', 'districts'));
    }

    public function addressStore(Request $request)
    {
        $request->validate([
            'name'      => 'required |string | max:150',
            'company'   => 'nullable |string | max:150',
            'country'   => 'required |string | max:150',
            'district'   => 'required | integer | min:1 | max:64',
            'city'   => 'required | string |  max:150',
            'zip_code'   => 'required | between:1, 20000',
            'house_and_street'   => 'required | string | max:200',
        ]);

        $address               = Address::updateOrCreate(['user_id' => Auth::user()->user_id],
                                            [
                                                'name'          => $request->name,
                                                'company'       => $request->company,
                                                'country'       => $request->country,
                                                'district_id'   => $request->district,
                                                'city'          => $request->city,
                                                'zip_code'      => $request->zip_code,
                                                'house_and_street' => $request->house_and_street,
                                                'user_id'       => Auth::user()->user_id,
                                            ]);

        if($address)
        {
            $notification = array('message' => 'Information inserted successfully', 'alert-type'=> 'success');
            return redirect()->route('address')->with($notification);
        }
        $notification = array('message' => 'Something went Wrong!', 'alert-type'=> 'error');
        return redirect()->route('address')->with($notification);
    }

    public function accountDetails()
    {
        return view('front.user.account');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function accountFacebook()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        dd($user);
    }

    public function newsletterSubscription(Request  $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:100', 'unique:newsletter_subscriptions'],
        ]);
        $newsletter             = new NewsletterSubscription;
        $newsletter->email      =  $request->email;
        $user_newsletter = User::where('email', $request->email)->first();
        if($user_newsletter)
        {
            if($user_newsletter)
            {
                $user_newsletter->newsletter_subscribed = 1;
                $user_newsletter->newsletter_discount_available = 1;
                $user_newsletter->newsletter_subscribed_at = date('Y-m-d H:i:s');
                $user_newsletter->save();
                $newsletter->save();
            }

            $notification = array('message' => 'Newsletter Subscribed successfully', 'alert-type'=> 'success');
            return response()->json(['notification'=>$notification, 'status' => true]);
        }
        $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        return response()->json(['notification'=>$notification, 'status' => false]);
    }



    // public function newsletterSubscription(Request  $request)
    // {
    //     $request->validate([
    //         'email' => ['required', 'string', 'email', 'max:100', 'unique:newsletter_subscriptions'],
    //     ]);
    //     $newsletter             = new NewsletterSubscription;
    //     $newsletter->email      =  $request->email;
    //     if($newsletter->save())
    //     {
    //             $user_newsletter = User::where('email', $request->email)->first();
    //             if($user_newsletter)
    //             {
    //                 $user_newsletter->newsletter_subscribed = 1;
    //                 $user_newsletter->newsletter_discount_available = 1;
    //                 $user_newsletter->newsletter_subscribed_at = date('Y-m-d H:i:s');
    //                 $user_newsletter->save();
    //             }

    //         $notification = array('message' => 'Newsletter Subscribed successfully', 'alert-type'=> 'success');
    //         return response()->json(['notification'=>$notification, 'status' => true]);
    //     }
    //     $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
    //     return response()->json(['notification'=>$notification, 'status' => false]);
    // }
}
