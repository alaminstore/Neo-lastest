<?php

namespace App\Http\Controllers;

use App\Models\ContactusInfo;
use Illuminate\Http\Request;

class ContactusInfoController extends Controller
{
    public function index()
    {
        $contact_info = ContactusInfo::get();
        return view('backend.admins.contact_us_info', compact('contact_info'));
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
            'factory'      => 'required',
            'marketing_distribution'   => 'required ',
            'phone' => 'required|numeric|min:10',
            'email' => 'required',
            'messenger' => 'nullable',
        ]);

        $contactus           = new ContactusInfo();
        $contactus->factory = $request->factory;
        $contactus->marketing_distribution = $request->marketing_distribution;
        $contactus->phone = $request->phone;
        $contactus->email = $request->email;
        $contactus->messenger = $request->messenger;

//       return $request->all()
        if($contactus->save())
        {
            $notification = array('message' => 'Contact Us Information added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.contactus')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     * @return Response
     */
    public function edit($id)
    {
        $contactus  = ContactusInfo::find($id);
        return response()->json($contactus);
    }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param Request $request
//      * @param Slider $slider
//      * @return Response
//      */
    public function updated(Request $request)
    {
        $request->validate([
            'factory'      => 'required',
            'marketing_distribution'   => 'required ',
            'phone' => 'required|numeric|min:10',
            'email' => 'required',
            'messenger' => 'nullable',
        ]);

        $contactus = ContactusInfo::find($request->id);
        $contactus->factory = $request->factory;
        $contactus->marketing_distribution = $request->marketing_distribution;
        $contactus->phone = $request->phone;
        $contactus->email = $request->email;
        $contactus->messenger = $request->messenger;

        if($contactus->save())
        {
            $notification = array('message' => 'Contact us info updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.contactus')->with($notification);
    }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param Slider $slider
//      * @return Response
//      */
        public function destroy($id)
        {
            $contactus = ContactusInfo::find($id);
        if ($contactus->delete()) {
            $notification = array('message' => 'Contact us info deleted successfully', 'alert-type' => 'success');
        } else {
            $notification = array('message' => 'Someting went wrong!', 'alert-type' => 'error');
        }
            return redirect()->route('admin.contactus')->with($notification);
        }
}
