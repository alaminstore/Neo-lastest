<?php

namespace App\Http\Controllers;

use App\Models\Contractus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactusBannerController extends Controller
{
    public function index(){
        $banner = Contractus::get();
        return view('backend.Contactus.contact_banner',compact('banner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required | mimes:png,jpeg,jpg',
        ]);

        $slider = new Contractus();
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

        return redirect()->route('admin.contact_us.banner')->with($notification);

    }


    public function destroy($id)
    {
        $banner = Contractus::find($id);
        if($banner->delete())
        {
            $notification = array('message' => 'Banner deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.contact_us.banner')->with($notification);
    }
}
