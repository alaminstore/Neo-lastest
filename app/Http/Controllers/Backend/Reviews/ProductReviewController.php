<?php

namespace App\Http\Controllers\Backend\Reviews;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::with('ProductItem','user')->get();

        return view('backend.reviews.product_reviews.product_reviews', compact('reviews'));
    }

    public function view($id)
    {
        $review = ProductReview::with('ProductItem')->where('product_review_id', $id)->first();
        return response()->json($review);
    }

    public function reply($id)
    {
        $reply = ProductReview::with('ProductItem')->where('product_review_id', $id)->first();
        return response()->json($reply);
    }

    public function reviewUpdate(Request $request)
    {
        $request->validate([
            'review_id' => 'required | numeric',
        ]);

        $update = ProductReview::where('product_review_id', $request->review_id)->update(['reply_id' => Auth::user()->user_id, 'reply' => $request->reply , 'status'=> $request->reply != null ? 1 : 0]);
        if($update)
        {
            $notification = array('message' => 'Replay Added successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.product.reviews')->with($notification);
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'success');
            return redirect()->route('admin.product.reviews')->with($notification);
        }
    }
}
