<?php

namespace App\Http\Controllers;

use App\Models\Orderbanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderbannerController extends Controller
{
    public function index(){
        $banner = Orderbanner::get();
        return view('backend.orders.order_banner',compact('banner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required | mimes:png,jpeg,jpg',
        ]);

        $slider = new Orderbanner();
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

        return redirect()->route('admin.order_tracking_banner')->with($notification);

    }


    public function destroy($id)
    {
        DB::beginTransaction();
        $about_banner = Orderbanner::findOrFail($id);
        $about_banner->delete();
        DB::commit();
        $notification = array('message' => 'Banner deleted successfully', 'alert-type' => 'success');
//        if ($about_banner->delete()) {
//            $notification = array('message' => 'Slider deleted successfully', 'alert-type' => 'success');
//        } else {
//            $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
//        }
        return redirect()->route('admin.order_tracking_banner')->with($notification);
    }
}
