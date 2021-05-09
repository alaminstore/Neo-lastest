<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Setting;
use function compact;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting  = Setting::where('id',1)->first();
        return view('backend.settings.settings', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'          => 'nullable | max:255| string',
            'email'         => 'nullable | email | max:255',
            'phone'         => 'nullable | string | max:100',
            'logo'          => 'nullable | mimes: jpg,jpeg,png,gif',
            'small_logo'    => 'nullable | mimes: jpg,jpeg,png,gif',
            'favicon'       => 'nullable | mimes: jpg,jpeg,png,gif',
            'facebook'      => 'nullable | string | max:255',
            'twitter'       => 'nullable | string | max:255',
        ]);
        $setting                = Setting::where('id',1)->first();
        $setting_logo           = $setting->logo ?? '';
        $setting_small_logo     = $setting->small_logo ?? '';
        $setting_favicon        = $setting->favicon ?? '';

        if($request->hasFile('logo'))
        {
            @unlink($setting_logo);
            $path               = 'uploads/settings/';

            $logo              = $request->logo;
            $logoName          = time().'1'.$logo->getClientOriginalName();

            $logo->move($path,$logoName);
            $setting_logo  = $path.$logoName;
        }

        if($request->hasFile('small_logo'))
        {
            @unlink($setting_small_logo);
            $path               = 'uploads/settings/';

            $sticky              = $request->small_logo;
            $stickyName          = time().'2'.$sticky->getClientOriginalName();

            $sticky->move($path,$stickyName);
            $setting_small_logo  = $path.$stickyName;
        }

        if($request->hasFile('favicon'))
        {
            @unlink($setting_favicon);
            $path               = 'uploads/settings/';

            $favicon              = $request->favicon;
            $faviconName          = time().'3'.$favicon->getClientOriginalName();

            $favicon->move($path,$faviconName);
            $setting_favicon  = $path.$faviconName;
        }

        $setting            = Setting::updateOrCreate(['id'=>1],['name'=> $request->name,  'email'=> $request->email, 'phone'=> $request->phone, 'address'=> $request->address, 'logo'=> $setting_logo,'small_logo'=> $setting_small_logo, 'favicon'=> $setting_favicon, 'facebook'=> $request->facebook, 'twitter'=> $request->twitter]);

        if($setting)
        {
            $notification = array('message' => 'Setting updated successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.web.setting')->with(['notification'=> $notification]);
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.web.setting')->with(['notification'=> $notification]);
        }
    }
}
