<?php

namespace App\Http\Controllers;

use App\Models\PrivacyBanner;
use Illuminate\Support\Facades\DB;
use App\Models\Privacypolicy;
use Illuminate\Http\Request;

class PrivacypolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policies = Privacypolicy::get();
        $banner = PrivacyBanner::get();
        return view('backend.admins.privacypolicy.privacypolicy',compact('policies',));
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
            'answer'  => 'required ',
        ]);

        $privacy                    = new Privacypolicy();
        $privacy->answer            = $request->answer;
        if($privacy->save())
        {
            $notification = array('message' => 'Privacy Policy  added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.privacy_policy')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $policy = Privacypolicy::find($id);
        return response()->json($policy);
    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
    public function updated(Request $request , $id)
    {
        $request->validate([
            'answer' => 'required ',
        ]);

        DB::beginTransaction();
        $policy = Privacypolicy::findOrFail($id);
        $policy->answer = $request->answer;
        $policy->save();
        DB::commit();
        if($policy->save())
        {
            $notification = array('message' => 'Privacy Policy updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.privacy_policy')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $policies = Privacypolicy::findOrFail($id);
        if($policies->delete())
        {
            $notification = array('message' => 'Privacy Policy deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.privacy_policy')->with($notification);
    }


    // Banner Portion

    public function banner_store(Request $request){
        $request->validate([
            'image' => 'required | mimes:png,jpeg,jpg',
        ]);

        $slider = new PrivacyBanner();
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

        return redirect()->route('admin.privacy_policy')->with($notification);

    }

    public function banner_destroy($id){
        $banner = PrivacyBanner::find($id);
       if ($banner->delete()) {
           $notification = array('message' => 'Banner deleted successfully', 'alert-type' => 'success');
       } else {
           $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
       }
        return redirect()->route('admin.privacy_policy')->with($notification);
    }
}
