<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductInfo;
use App\Models\ProductItem;
use App\Models\ProductWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_infos = ProductInfo::with('productWeight', 'productItem')->get();
        // return $product_infos;

        return view('backend.products.product_infos.product_infos', compact('product_infos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_items  = ProductItem::orderBy('product_item_name', 'asc')->get();
        $weights        = ProductWeight::orderBy('weight', 'asc')->get();

        return view('backend.products.product_infos.product_info_create', compact('product_items', 'weights'));
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
            'price'             => 'required  | between:1,99999999.99',
            'sales_price'       => 'nullable | between:1,99999999.99',
            'product_item'      => 'required | string| between:1,10000000000',
            'weight'            => 'required  | between:1,10000000000',
            'product_quantity'  => 'required  | integer | max:1000000000',
            'sku'               => 'nullable | string | max: 250',
        ]);
        DB::beginTransaction();
        try {
            $product_info                             = new ProductInfo;
            $product_info->price                      = $request->price;
            $product_info->sales_price                = $request->sales_price;
            $product_info->percent                    = $this->percentCount($request->price, $request->sales_price);
            $product_info->product_item_id            = $request->product_item;
            $product_info->product_weight_id          = $request->weight;
            $product_info->product_quantity           = $request->product_quantity;
            $product_info->sku                        = $request->sku;

            $product_info->save();


            DB::commit();
            $notification = array('message' => 'Product Info Created successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.productinfos.index')->with($notification);

        } catch (\Exception $e) {
            DB::rollback();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.productinfos.index')->with($notification);
        }
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
        $product_info   = ProductInfo::findOrFail($id);
        $product_items  = ProductItem::orderBy('product_item_name', 'asc')->get();
        $weights        = ProductWeight::orderBy('weight', 'asc')->get();

        return view('backend.products.product_infos.product_info_edit', compact('product_info','product_items', 'weights'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//dd($request);
        $request->validate([
            'price'             => 'required | between:1,99999999.99',
            'sales_price'       => 'nullable | between:1,99999999.99',
            'product_item'      => 'required | string | between:1,10000000000',
            'weight'            => 'required  | between:1,10000000000',
            'product_quantity'  => 'required  | integer | max:1000000000',
            'sku'               => 'nullable | string | max: 250',
        ]);
        DB::beginTransaction();
        try {
            $product_info                             = ProductInfo::findOrFail($id);
            $product_info->price                     = $request->price;
            $product_info->sales_price                = $request->sales_price;
            $product_info->percent                    = round($this->percentCount($request->price, $request->sales_price));
            $product_info->product_item_id            = $request->product_item;
            $product_info->product_weight_id          = $request->weight;
            $product_info->product_quantity           = $request->product_quantity;
            $product_info->sku                        = $request->sku;
            $product_info->save();


            DB::commit();
            $notification = array('message' => 'Product Info Updated successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.productinfos.index')->with($notification);

        } catch (\Exception $e) {

            DB::rollback();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.productinfos.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $product_info = ProductInfo::where('product_info_id', $id)->firstOrFail();

            $product_info->delete();

            DB::commit();
            $notification = array('message' => 'Product Info deleted successfully', 'alert-type'=> 'success');

            return redirect()->route('admin.productinfos.index')->with($notification);
        } catch (\Exception $e) {

            DB::rollback();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.productinfos.index')->with($notification);
        }
    }

    public function percentCount($regular_price, $sales_price)
    {
        $percent = 0;
        if($sales_price)
        {
            if($regular_price > $sales_price)
            {

                $percent =  round(100-(($sales_price*100)/$regular_price), 1);
                return $percent;
            }
            return $percent;
        }
        return $percent;
    }
}
