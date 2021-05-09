<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function strtotime;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::with('blogCategory')->get();

        return view('backend.blogs.blogs.blogs', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::Orderby('category_name')->get();
        return view('backend.blogs.blogs.blog_create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'blog_header'        => 'required | string| max:200',
            'blog_category'      => 'required  | between:1,10000000000',
            'full_image'         => 'required | mimes:jpg,jpeg,png',
            'thumbnail_image'    => 'required | mimes:jpg,jpeg,png',
            'post_date'          => 'required | date ',
        ]);
        DB::beginTransaction();
        try {
            $blog                      = new Blog;
            $blog->blog_header         = $request->blog_header;
            $blog->user_id             = Auth::user()->user_id;
            $blog->slug                = Str::slug($request->blog_header);
            $blog->blog_category_id    = $request->blog_category;
            $blog->post_date           = date('Y-m-d', strtotime($request->post_date));
            $blog->description         = $request->description;
            $blog->save();

            if($request->hasFile('full_image'))
            {
                $path           = 'images/blogs/'.$blog->blog_id.'/';

                if (!is_dir($path))
                {
                    mkdir($path, 0755, true);
                }

                $blog_full_image      = Blog::find($blog->blog_id);

                $image              = $request->full_image;
                $imageName          = '1'.$image->getClientOriginalName();

                $image->move($path,$imageName);
                $blog_full_image->full_image           = $path.$imageName;
                $blog_full_image->save();
            }

            if($request->hasFile('thumbnail_image'))
            {
                $path           = 'images/blogs/'.$blog->blog_id.'/';

                if (!is_dir($path))
                {
                    mkdir($path, 0755, true);
                }

                $blog_thumbnail_image      = Blog::find($blog->blog_id);

                $image              = $request->thumbnail_image;
                $imageName          = '2'.$image->getClientOriginalName();

                $image->move($path,$imageName);
                $blog_thumbnail_image->thumbnail_image           = $path.$imageName;
                $blog_thumbnail_image->save();
            }

            DB::commit();
            $notification = array('message' => 'Blog Created successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.blogs.index')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.blogs.index')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::with('blogCategory')->findOrFail($id);
        $categories = BlogCategory::Orderby('category_name')->get();
        return view('backend.blogs.blogs.blog_edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'blog_header'        => 'required | string| max:200',
            'blog_category'      => 'required  | between:1,10000000000',
            'full_image'         => 'nullable | mimes:jpg,jpeg,png',
            'thumbnail_image'    => 'nullable | mimes:jpg,jpeg,png',
            'post_date'          => 'required | date',
        ]);
        DB::beginTransaction();
        try {
            $blog                      = Blog::findOrFail($id);
            $blog->blog_header         = $request->blog_header;
            $blog->user_id             = Auth::user()->user_id;
            $blog->slug                = Str::slug($request->blog_header);
            $blog->blog_category_id    = $request->blog_category;
            $blog->post_date           = date('Y-m-d', strtotime($request->post_date));
            $blog->description         = $request->description;
            $blog->save();

            if($request->hasFile('full_image'))
            {
                $path           = 'images/blogs/'.$blog->blog_id.'/';

                if (!is_dir($path))
                {
                    mkdir($path, 0755, true);
                }

                $blog_full_image      = Blog::find($blog->blog_id);
                @unlink($blog_full_image->full_image);

                $image              = $request->full_image;
                $imageName          = '1'.$image->getClientOriginalName();

                $image->move($path,$imageName);
                $blog_full_image->full_image           = $path.$imageName;
                $blog_full_image->save();
            }

            if($request->hasFile('thumbnail_image'))
            {
                $path           = 'images/blogs/'.$blog->blog_id.'/';

                if (!is_dir($path))
                {
                    mkdir($path, 0755, true);
                }

                $blog_thumbnail_image      = Blog::find($blog->blog_id);
                @unlink($blog_thumbnail_image->thumbnail_image);
                $image              = $request->thumbnail_image;
                $imageName          = '2'.$image->getClientOriginalName();

                $image->move($path,$imageName);
                $blog_thumbnail_image->thumbnail_image           = $path.$imageName;
                $blog_thumbnail_image->save();
            }

            DB::commit();
            $notification = array('message' => 'Blog Updated successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.blogs.index')->with($notification);

        } catch (\Exception $e) {
            DB::rollback();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.blogs.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $blog = Blog::where('blog_id', $id)->firstOrFail();
            @unlink($blog->full_image);
            @unlink($blog->thumbnail_image);
            $blog->delete();

            DB::commit();
            $notification = array('message' => 'Blog deleted successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.blogs.index')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.blogs.index')->with($notification);
        }
    }
}
