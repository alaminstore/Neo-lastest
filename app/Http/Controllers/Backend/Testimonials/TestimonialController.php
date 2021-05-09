<?php

namespace App\Http\Controllers\Backend\Testimonials;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('backend.cms.testimonials.testimonials', compact('testimonials'));
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
            'person_name'   => 'required | max:100',
            'designation'   => 'required | string | max: 255',
            'description'   => 'required',
        ]);

        $testimonial                     = new Testimonial;
        $testimonial->person_name        = $request->person_name;
        $testimonial->designation        = $request->designation;
        $testimonial->description        = $request->description;

        if($testimonial->save())
        {
            $notification = array('message' => 'Testimonial added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.testimonials.index')->with($notification);
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
        $testimonial  = Testimonial::find($id);
        return response()->json($testimonial);
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
            'testimonial_id'    => 'required',
            'person_name'       => 'required | max:100',
            'designation'       => 'required | string | max: 255',
            'description'       => 'required',
        ]);

        $testimonial                     =  Testimonial::find($request->testimonial_id);
        $testimonial->person_name        = $request->person_name;
        $testimonial->designation        = $request->designation;
        $testimonial->description        = $request->description;

        if($testimonial->save())
        {
            $notification = array('message' => 'Testimonial updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.testimonials.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial  =  Testimonial::find($id);
        if($testimonial->delete())
        {
            $notification = array('message' => 'Testimonial deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.testimonials.index')->with($notification);
    }
}
