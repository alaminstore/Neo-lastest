<?php

namespace App\Http\Controllers\Backend\Setting;

use App\GeneralSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $general_setting = GeneralSetting::where('id',1)->first();
        return view('backend.settings.general_settings', compact('general_setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'shipping'          => 'nullable | numeric',
        ]);
        $general_setting                = GeneralSetting::where('id',1)->first();



        $general_setting            = GeneralSetting::updateOrCreate(['id'=>1],['shipping'=> $request->shipping]);

        if($general_setting)
        {
            $notification = array('message' => 'General setting updated successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.general.setting')->with(['notification'=> $notification]);
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.general.setting')->with(['notification'=> $notification]);
        }
    }
}
