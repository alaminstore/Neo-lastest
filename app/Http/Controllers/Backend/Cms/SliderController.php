<?php

namespace App\Http\Controllers\Backend\Cms;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function unlink;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sliders = Slider::get();
        return view('backend.cms.home.sliders.sliders', compact('sliders'));
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
            'add_link'   => 'nullable | string | max: 255',
        ]);

        $slider           = new Slider;
        $slider->add_link = $request->add_link;
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

        if($slider->save())
        {
            $notification = array('message' => 'Slider added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.sliders.index')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     * @return Response
     */
    public function edit($id)
    {
        $slider  = Slider::find($id);
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
        return $request->id;
        $request->validate([
            'image' => 'nullable | mimes:png,jpeg,jpg',
            'add_link' => 'nullable | string | max: 255',
        ]);

        $slider= Slider::find($request->slider_id);
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
        $slider->add_link      = $request->add_link;
        if($slider->save())
        {
            $notification = array('message' => 'Slider updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.sliders.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return Response
     */
    public function destroy(Slider $slider)
    {
        @unlink($slider->image);
        if($slider->delete())
        {
            $notification = array('message' => 'Slider deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.sliders.index')->with($notification);
    }
}
