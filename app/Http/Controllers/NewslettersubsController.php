<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\NewsletterContent;
use Illuminate\Http\Request;

class NewslettersubsController extends Controller
{
    public function index(){
        $subscribtion = NewsletterContent::get();
        return view('backend.admins.newsletter',compact('subscribtion'));
    }

    public function store(Request $request){
        $request->validate([
            'discount_amount' => 'required',
        ]);

        $newsletter                        = new NewsletterContent;
        $newsletter->discount_amount       = $request->discount_amount;
        $newsletter->status                = 1;
        if($newsletter->save())
        {
            $notification = array('message' => 'Newsletter % selected successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.newsletter.customer')->with($notification);
    }

    public function edit($id)
    {
        $newsletter  = NewsletterContent::find($id);
        return response()->json($newsletter);
    }


    public function updated(Request $request)
    {
        $request->validate([
            'discount_amount' => 'required',
        ]);

        $newsletter = NewsletterContent::find($request->id);
        $newsletter->discount_amount       = $request->discount_amount;
        $newsletter->status                = 1;

        if($newsletter->save())
        {
            $notification = array('message' => 'Newsletter Percentage updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.newsletter.customer')->with($notification);
    }


    public function destroy($id){
        $newsletter = NewsletterContent::findorFail($id);
       if ($newsletter->delete()) {
           $notification = array('message' => 'Percentage deleted successfully', 'alert-type' => 'success');
       } else {
           $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
       }
        return redirect()->route('admin.newsletter.customer')->with($notification);
    }
}
