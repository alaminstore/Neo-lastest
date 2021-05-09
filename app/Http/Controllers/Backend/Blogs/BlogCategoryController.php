<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BlogCategory::get();

        return view('backend.blogs.categories.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'category_name' => 'required | string | max: 200  | unique:blog_categories',
        ]);

        $category                        = new BlogCategory;
        $category->category_name         = $request->category_name;
        $category->slug                  = Str::slug($request->category_name);
        if($category->save())
        {
            $notification = array('message' => 'Blog Category added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.blogcategories.index')->with($notification);
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
        $category  = BlogCategory::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'category_name' => ['required', 'string', 'max: 200', Rule::unique('blog_categories', 'category_name')->ignore($request->category_id, 'blog_category_id')->where(function ($query) use ($request) {
                $query->where('category_name', $request->category_name);
            })],
        ]);

        $category                   = BlogCategory::findOrFail($request->category_id);
        $category->category_name    = $request->category_name;
        $category->slug             = Str::slug($request->category_name);
        if($category->save())
        {
            $notification = array('message' => 'Blog Category updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.blogcategories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category        = BlogCategory::findOrFail($id);

//        $category_exist  = Blog::where('blog_category_id', $id)->first();

//        if($category_exist)
//        {
//            $notification        = array('message' => 'Please first remove from blog.', 'alert-type'=> 'error');
//            return redirect()->route('admin.categories.index')->with($notification);
//        }

        if($category->delete())
        {
            $notification = array('message' => 'Blog Category deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.blogcategories.index')->with($notification);
    }
}
