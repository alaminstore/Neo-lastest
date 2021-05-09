<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductInfo;
use App\Models\ProductWeight;
use Illuminate\Http\Request;

class ProductWeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weights = ProductWeight::get();
        return view('backend.products.weights.weights', compact('weights'));
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
            'weight' => 'required | between:0,999999.99',
            'weight_unit' => 'required | string | max: 20 ',
        ]);

        $weight                 = new ProductWeight;
        $weight->weight         = $request->weight;
        $weight->weight_unit    = $request->weight_unit;
        if($weight->save())
        {
            $notification = array('message' => 'Weight added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.productweights.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductWeight  $productWeight
     * @return \Illuminate\Http\Response
     */
    public function show(ProductWeight $productWeight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductWeight  $productWeight
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $weight  = ProductWeight::findOrFail($id);
        return response()->json($weight);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductWeight  $productWeight
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $request->validate([
            'weight' => 'required | between:0,999999.99',
            'weight_unit' => 'required | string | max: 20 ',
        ]);

        $weight                 = ProductWeight::findOrFail($request->product_weight_id);
        $weight->weight         = $request->weight;
        $weight->weight_unit    = $request->weight_unit;
        if($weight->save())
        {
            $notification = array('message' => 'Weight Updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.productweights.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductWeight  $productWeight
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wieght        = ProductWeight::findOrFail($id);
        $wieght_exist  = ProductInfo::where('product_weight_id', $id)->first();

        if($wieght_exist)
        {
            $notification        = array('message' => 'Please first remove from product info.', 'alert-type'=> 'error');
            return redirect()->route('admin.productweights.index')->with($notification);
        }


        if($wieght->delete())
        {
            $notification = array('message' => 'Weight deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.productweights.index')->with($notification);
    }
}
