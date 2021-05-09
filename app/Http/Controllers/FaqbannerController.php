<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Faqbanner;
use Illuminate\Http\Request;

class FaqbannerController extends Controller
{
    public function index()
    {
        $banner = Faqbanner::get();
        return view('backend.cms.faqs.faqbanner',compact('banner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required | mimes:png,jpeg,jpg',
        ]);

        $slider = new Faqbanner();
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

        return redirect()->route('admin.faq_banner')->with($notification);

    }

//    public function edit($id){
//        $banner  = AboutUsBanner::find($id);
//        return response()->json($banner);
//    }
//    public function udpate(Request $request){
//
//        $request->validate([
//            'image' => 'nullable | mimes:png,jpeg,jpg',
//            'add_link' => 'nullable | string | max: 255',
//        ]);
//
//        $banner = AboutUsBanner::find($request->id);
//        if($request->hasFile('image'))
//        {
//            $path  = 'images/banners/';
//            @unlink($banner->image);
//            if (!is_dir($path))
//            {
//                mkdir($path, 0755, true);
//            }
//
//            $image              = $request->image;
//            $imageName          = rand(100,1000).$image->getClientOriginalName();
//
//            $image->move($path,$imageName);
//            $banner->image      = $path.$imageName;
//        }
//        $banner->add_link      = $request->add_link;
//        if($banner->save())
//        {
//            $notification = array('message' => 'Banner updated successfully', 'alert-type'=> 'success');
//        }
//        else
//        {
//            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
//        }
//
//        return redirect()->route('admin.faq_banner')->with($notification);
//    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $banner = Faqbanner::findOrFail($id);
        $banner->delete();
        DB::commit();
        $notification = array('message' => 'Banner deleted successfully', 'alert-type' => 'success');
//        if ($about_banner->delete()) {
//            $notification = array('message' => 'Slider deleted successfully', 'alert-type' => 'success');
//        } else {
//            $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
//        }
        return redirect()->route('admin.faq_banner')->with($notification);
    }
}
