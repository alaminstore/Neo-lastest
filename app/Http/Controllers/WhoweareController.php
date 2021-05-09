<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Whoweare;
use Illuminate\Http\Request;

class WhoweareController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whowe = Whoweare::get();
        return view('backend.admins.about_us.who_we_are',compact('whowe'));
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
            'image'   => 'required ',
            'title'   => 'required | string | max: 200',
            'description' => 'required ',
        ]);

        $whowe           = new Whoweare();
        $whowe->title = $request->title;
        $whowe->description = $request->description;
        if($request->hasFile('image'))
        {
            $path           = 'images/whoweare/';

            if (!is_dir($path))
            {
                mkdir($path, 0755, true);
            }

            $image              = $request->image;
            $imageName          = rand(100,1000).$image->getClientOriginalName();

            $image->move($path,$imageName);
            $whowe->image      = $path.$imageName;
        }
        if($whowe->save())
        {
            $notification = array('message' => 'About us added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.about_us.Whoweare')->with($notification);
    }


//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
        public function edit($id)
        {
            $faq  = Whoweare::find($id);
            return response()->json($faq);
        }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
    public function updated(Request $request , $id)
    {
        $request->validate([
            'image'   => 'required ',
            'title'   => 'required | string | max: 200',
            'description' => 'required ',
        ]);

        DB::beginTransaction();
        $whowe = Whoweare::findOrFail($id);
        $whowe->title             = $request->title;
        $whowe->description       = $request->description;

        if($request->hasFile('image'))
        {
            $path           = 'images/whoweare/';
            @unlink($whowe->image);
            if (!is_dir($path))
            {
                mkdir($path, 0755, true);
            }

            $image              = $request->image;
            $imageName          = rand(100,1000).$image->getClientOriginalName();

            $image->move($path,$imageName);
            $whowe->image      = $path.$imageName;
        }

        $whowe->save();
        DB::commit();
        if($whowe->save())
        {
            $notification = array('message' => 'About us updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.about_us.Whoweare')->with($notification);

    }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
    public function destroy($id)
    {
        $who = Whoweare::findOrFail($id);
        if($who->delete())
        {
            $notification = array('message' => 'About Us deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.about_us.Whoweare')->with($notification);
    }
}
