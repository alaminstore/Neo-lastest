<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Termscondition;
use App\Models\TermsConditionBanner;
use Illuminate\Http\Request;

class TermsconditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Termscondition::get();
        $banner = TermsConditionBanner::get();
        return view('backend.admins.termscondition.termscondition',compact('terms','banner'));
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

        $terms                    = new Termscondition();
        $terms->answer            = $request->answer;
        if($terms->save())
        {
            $notification = array('message' => 'Terms & Condition  added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.terms_condition')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $terms = Termscondition::find($id);
        return response()->json($terms);
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
        $terms = Termscondition::findOrFail($id);
        $terms->answer = $request->answer;
        $terms->save();
        DB::commit();
        if($terms->save())
        {
            $notification = array('message' => 'Terms & Condition updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.terms_condition')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terms = Termscondition::findOrFail($id);
        if($terms->delete())
        {
            $notification = array('message' => 'Terms & Condition deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.terms_condition')->with($notification);
    }


// Banner Portion=================================================================================

    public function banner_store(Request $request){
        $request->validate([
            'image' => 'required | mimes:png,jpeg,jpg',
        ]);

        $slider = new TermsConditionBanner();
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

        return redirect()->route('admin.terms_condition')->with($notification);

    }
    public function banner_destroy($id)
    {
        $banner = TermsConditionBanner::find($id);
       if ($banner->delete()) {
           $notification = array('message' => 'Banner deleted successfully', 'alert-type' => 'success');
       } else {
           $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
       }
        return redirect()->route('admin.terms_condition')->with($notification);
    }


}
