<?php

namespace App\Http\Controllers\Backend\Discount;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\OrderItem;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = ProductSubCategory::get();
        $discounts      = Discount::with("ProductSubcategory")->get();
        // return $discounts;
        return view('backend.discounts.discounts', compact('sub_categories', 'discounts'));
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
            'discount_percentage'   => 'required',
            'product_sub_category'  => 'required | integer',
            'active'                => 'required | min:0 | max:1',

        ]);

        $dsicount                               = new Discount;
        $dsicount->discount_percentage          = $request->discount_percentage;
        $dsicount->product_sub_category_id      = $request->product_sub_category;
        $dsicount->active                       = $request->active;
        if($dsicount->save())
        {
            $notification = array('message' => 'Discount added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.discounts.index')->with($notification);
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
        $percent  = Discount::with('ProductSubcategory')->findOrFail($id);
        return response()->json($percent);
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
            'discount_percentage'   => 'required',
            'product_sub_category'  => 'required | integer',
            'active'                => 'required | min:0 | max:1',

        ]);

        $dsicount                               =  Discount::findOrFail($request->discount_id);
        $dsicount->discount_percentage          = $request->discount_percentage;
        $dsicount->product_sub_category_id      = $request->product_sub_category;
        $dsicount->active                       = $request->active;
        if($dsicount->save())
        {
            $notification = array('message' => 'Discount updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.discounts.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount_exist = OrderItem::where('discount_id', $id)->first();
        if($discount_exist) {
            $notification = array('message' => 'This discount already applied.', 'alert-type'=> 'error');
            return redirect()->route('admin.discounts.index')->with($notification);
        }

        if($discount->delete()) {
            $notification = array('message' => 'Discount deleted successfully', 'alert-type'=> 'success');
        } else {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.discounts.index')->with($notification);
    }
}
