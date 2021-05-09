<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\ProductInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favorites()
    {
        $favorites = Favorite::with('productInfo')
                            ->where('user_id', Auth::user()->user_id)
                            ->get();
//        dd($favorites);
        return view('front.user.favorites', compact('favorites'));
    }

    public function favoriteAdd(Request  $request)
    {

        if(!Auth::check())
        {
            $notification = array('message' => 'Please login first!', 'alert-type'=> 'error');
            return response()->json(['notification' =>$notification]);
        }

        $product        = ProductInfo::where('product_info_id', $request->product_info_id)->firstOrFail();
        $favorite       = Favorite::where('product_info_id',$request->product_info_id)->where('user_id',Auth::user()->user_id)->first();

        if($favorite)
        {
            $notification = array('message' => 'Product is already in favorites!', 'alert-type'=> 'error');
            return response()->json(['notification' =>$notification]);
        }

        $favorite                       = new Favorite;
        $favorite->product_info_id      = $request->product_info_id;
        $favorite->user_id              = Auth::user()->user_id;
        if($favorite->save())
        {
            $notification = array('message' => 'Product added to favorites', 'alert-type'=> 'success');
            return response()->json(['notification' =>$notification]);
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'success');
            return response()->json(['notification' =>$notification]);
        }
    }

    public function favoriteRemove($id)
    {
        $favorite = Favorite::where('favorite_id',$id)->where('user_id', Auth::user()->user_id)->firstOrFail();
        if($favorite->delete())
        {
            $notification = array('message' => 'Product removed from favorites', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('favorites',)->with($notification);
    }

    public function favoriteCheck($product_info_id,$user_id)
    {
        $set = false;
        if(Auth::check())
        {
            if(Auth::user()->user_id == $user_id)
            {
                $favorite = Favorite::where('product_info_id',$product_info_id)
                                    ->when(Auth::check(),function ($query){
                                        return $query->where('user_id', Auth::user()->user_id);
                                    })
                                    ->first();
                if($favorite)
                {
                    $set = true;
                }
            }
        }

        return response()->json(['set' => $set]);
    }
}
