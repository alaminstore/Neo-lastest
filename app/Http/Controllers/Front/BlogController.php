<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blogbanner;
use App\Models\BlogCategory;
use App\Models\BlogReview;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        $blogs = Blog::with('user','blogCategory','blogReview')
                        ->withCount(['blogReview as blog_review_count' => function ($query) {
                            $query->where('status', 1);
                        }])
                         ->orderBy('blog_id', 'desc')
                        ->paginate(8);
        $categories     = BlogCategory::orderBy('category_name', 'asc')->get();
        $banner = Blogbanner::get();

        return view('front.blog.blog', compact('blogs', 'categories','banner'));
    }

    public function categoryBlog($id)
    {
        $blogs = Blog::with('user','blogCategory', 'blogReview')
                    ->withCount(['blogReview as blog_review_count' => function ($query) {
                        $query->where('status', 1);
                    }])
                    ->where('blog_category_id', $id)
                    ->orderBy('blog_id', 'desc')
                    ->paginate(12);

        return view('front.blog.blog_category', compact('blogs'));
    }

    public function blogSingle($id)
    {
        $blog           = Blog::with('blogCategory')->findOrFail($id);
        $categories     = BlogCategory::orderBy('category_name', 'asc')->get();
        $recent_blogs   = Blog::orderBy('created_at','asc')->get()->take(4);
        $reviews        = BlogReview::with('user','replyUser')
                                ->where('blog_id', $id)
                                ->where('status', 1)
                                ->orderBy('blog_review_id', 'desc')
                                ->paginate(10);
        return view('front.blog.blog_single', compact('blog', 'categories', 'recent_blogs','reviews'));
    }
}
