<?php

namespace App\Http\Controllers\Backend\Reviews;

use App\Http\Controllers\Controller;
use App\Models\BlogReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogReviewController extends Controller
{
    public function index()
    {
        $reviews = BlogReview::with('blog','user')->get();

        return view('backend.reviews.blog_reviews.blog_reviews', compact('reviews'));
    }

    public function view($id)
    {
        $review = BlogReview::with('blog')->where('blog_review_id', $id)->first();
        return response()->json($review);
    }

    public function reply($id)
    {
        $reply = BlogReview::with('blog')->where('blog_review_id', $id)->first();
        return response()->json($reply);
    }

    public function reviewUpdate(Request $request)
    {
        $request->validate([
            'review_id' => 'required | numeric',
        ]);

        $update = BlogReview::where('blog_review_id', $request->review_id)->update(['reply_id' => Auth::user()->user_id ,'reply' => $request->reply , 'status'=> $request->reply != null ? 1 : 0]);
        if($update)
        {
            $notification = array('message' => 'Replay Added successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.blog.reviews')->with($notification);
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'success');
            return redirect()->route('admin.blog.reviews')->with($notification);
        }
    }
}
