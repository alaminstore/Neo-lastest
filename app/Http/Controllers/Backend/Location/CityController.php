<?php

namespace App\Http\Controllers\Backend\Location;

use App\City;
use App\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::with('district')->get();
        $districts = District::orderBy('name', 'ASC')->get();
//        dd($cities);
        return view('backend.cities.cities', compact('cities', 'districts'));
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
            'district_id' => 'required',
            'name' => 'required | string | max: 150  | unique:cities',
        ]);

        $city                = new City;
        $city->district_id   = $request->district_id;
        $city->name          = $request->name;
        if($city->save())
        {
            $notification = array('message' => 'City added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.cities.index')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return response()->json($city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $request->validate([
            'city_id' => 'required',
            'district_id' => 'required',
            'name' => 'required | string | max: 150  | unique:cities,name,'.$request->city_id,
        ]);

        $city                = City::find($request->city_id);
        $city->district_id   = $request->district_id;
        $city->name          = $request->name;
        if($city->save())
        {
            $notification = array('message' => 'City updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.cities.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        if($city->delete())
        {
            $notification = array('message' => 'City deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.cities.index')->with($notification);
    }

    public function cityFind($id)
    {
        $cities = City::where('district_id', $id)->get();
        return response()->json($cities);
    }
}
