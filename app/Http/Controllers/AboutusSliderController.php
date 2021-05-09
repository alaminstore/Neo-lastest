<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Aboutusslider;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function unlink;

class AboutusSliderController extends Controller
{
    public function index()
    {
        $sliders = Aboutusslider::get();
        return view('backend.admins.about_us.sliders', compact('sliders'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'      => 'required | mimes:png,jpeg,jpg',
            'name'   => 'nullable | string ',
            'designation'   => 'nullable',
        ]);

        $slider           = new Aboutusslider();
        $slider->name = $request->name;
        $slider->designation = $request->designation;
        if($request->hasFile('image'))
        {
            $path           = 'images/sliders/';

            if (!is_dir($path))
            {
                mkdir($path, 0755, true);
            }

            $image              = $request->image;
            $imageName          = rand(100,1000).$image->getClientOriginalName();

            $image->move($path,$imageName);
            $slider->image      = $path.$imageName;
        }
//       return $request->all();
        if($slider->save())
        {
            $notification = array('message' => 'New Team Meamber added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.about_us.slider')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     * @return Response
     */
    public function edit($id)
    {
        $slider  = Aboutusslider::find($id);
        return response()->json($slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Slider $slider
     * @return Response
     */
    public function updated(Request $request)
    {
        $request->validate([
            'image' => 'nullable | mimes:png,jpeg,jpg',
            'name'   => 'nullable | string ',
            'designation'   => 'nullable',
        ]);

        $slider = Aboutusslider::find($request->id);
        $slider->name = $request->name;
        $slider->designation = $request->designation;
        if($request->hasFile('image'))
        {
            $path           = 'images/sliders/';
            @unlink($slider->image);
            if (!is_dir($path))
            {
                mkdir($path, 0755, true);
            }

            $image              = $request->image;
            $imageName          = rand(100,1000).$image->getClientOriginalName();

            $image->move($path,$imageName);
            $slider->image      = $path.$imageName;
        }
        if($slider->save())
        {
            $notification = array('message' => 'Team Meamber updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.about_us.slider')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $about_slider = Aboutusslider::findOrFail($id);
        $about_slider->delete();
        DB::commit();
        $notification = array('message' => 'Team Member deleted successfully', 'alert-type' => 'success');
//        if ($about_banner->delete()) {
//            $notification = array('message' => 'Slider deleted successfully', 'alert-type' => 'success');
//        } else {
//            $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
//        }
        return redirect()->route('admin.about_us.slider')->with($notification);
    }
}
