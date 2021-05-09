<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ProductItem;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'name'      => 'required | string | max: 100',
            'email'     => 'required | string | max: 100| exists:users',
            'review'    => 'required | string',
            'product'   => 'required | numeric',
        ]);
        $product = ProductItem::where('product_item_id', $request->product)->firstOrFail();

        DB::beginTransaction();
        try{

            $review                      = new ProductReview;
            $review->product_item_id     = $request->product;
            $review->user_id             = Auth::user()->user_id;
            $review->review              = $request->review;
            $review->save();

            DB::commit();
            $notification = array('message' => 'Review posted successfully!', 'alert-type'=> 'success');
            return redirect()->route('shop.single',['id'=> $product->product_item_id, 'slug'=> $product->slug, 'page=review'])->with($notification);
        }catch(\Exception $e){

            DB::rollBack();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('shop.single',['id'=> $product->product_item_id, 'slug'=> $product->slug, 'page=review'])->with($notification);
        }
    }
}
