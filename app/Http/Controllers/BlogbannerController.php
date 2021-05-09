<?php

namespace App\Http\Controllers;

use App\Models\Blogbanner;
use Illuminate\Http\Request;

class BlogbannerController extends Controller
{
    public function index(){
        $banner = Blogbanner::get();
        return view('backend.blogs.blogs.blog_banner',compact('banner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required | mimes:png,jpeg,jpg',
        ]);

        $slider = new Blogbanner();
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

        return redirect()->route('admin.order_blog_banner')->with($notification);

    }


    public function destroy($id)
    {
        $banner = Blogbanner::find($id);
       if ($banner->delete()) {
           $notification = array('message' => 'Banner deleted successfully', 'alert-type' => 'success');
       } else {
           $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
       }
        return redirect()->route('admin.order_blog_banner')->with($notification);
    }
}
