<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogReview;
use App\Models\ProductItem;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogReviewController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'name'      => 'required | string | max: 100',
            'email'     => 'required | string | max: 100| exists:users',
            'review'    => 'required | string',
            'blog'      => 'required | numeric',
        ]);
        $blog = Blog::where('blog_id', $request->blog)->firstOrFail();

        DB::beginTransaction();
        try{

            $review                      = new BlogReview;
            $review->blog_id             = $request->blog;
            $review->user_id             = Auth::user()->user_id;
            $review->review              = $request->review;
            $review->save();

            DB::commit();
            $notification = array('message' => 'Review posted successfully!', 'alert-type'=> 'success');
            return redirect()->route('blog.single',['id'=> $blog->blog_id, 'slug'=> $blog->slug, 'page=review'])->with($notification);
        }catch(\Exception $e){

            DB::rollBack();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('blog.single',['id'=> $blog->blog_id, 'slug'=> $blog->slug, 'page=review'])->with($notification);
        }
    }
}
