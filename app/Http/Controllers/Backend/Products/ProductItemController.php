<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductInfo;
use App\Models\ProductItem;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_items = ProductItem::with('subCategoriy')->get();

        return view('backend.products.product_items.product_items', compact('product_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_categories = ProductSubCategory::orderBy('product_sub_category_name', 'asc')->get();
        return view('backend.products.product_items.product_item_create', compact('sub_categories'));
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
            'product_item_name' => 'required | string| max:200',
            'product_sub_category' => 'required  | between:1,10000000000',
            'image' => 'required',
            'new_arrival'       => 'nullable | boolean',
            'popular'           => 'nullable | boolean',
        ]);
        DB::beginTransaction();
        try {
            $product_item                             = new ProductItem;
            $product_item->product_item_name          = $request->product_item_name;
            $product_item->slug                       = Str::slug($request->product_item_name);
            $product_item->product_sub_category_id    = $request->product_sub_category;
            $product_item->product_item_description   = $request->product_item_description;
            $product_item->new_arrival                = $request->has('new_arrival') ? 1 : 0;
            $product_item->popular                    = $request->has('popular') ? 1 : 0;
            $product_item->save();
            if($request->hasFile('image'))
            {
                $path           = 'images/product_items/'.$product_item->product_item_id.'/';

                if (!is_dir($path))
                {
                    mkdir($path, 0755, true);
                }

                $product_image      = ProductItem::find($product_item->product_item_id);

                $image              = $request->image;
                $imageName          = $image->getClientOriginalName();

                $image->move($path,$imageName);
                $product_image->image           = $path.$imageName;
                $product_image->save();
            }

            DB::commit();
            $notification = array('message' => 'Product Item Created successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.productitems.index')->with($notification);

        } catch (\Exception $e) {
            DB::rollback();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.productitems.index')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function show(ProductItem $productItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_item = ProductItem::findOrFail($id);
        $sub_categories = ProductSubCategory::orderBy('product_sub_category_name', 'asc')->get();
        return view('backend.products.product_items.product_item_edit', compact('product_item', 'sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'product_item_name' => 'required | string| max:200',
            'product_sub_category' => 'required  | between:1,10000000000',
            'new_arrival'       => 'nullable | boolean',
            'popular'           => 'nullable | boolean',
        ]);

        DB::beginTransaction();
        try {
            $product_item                             = ProductItem::findOrFail($id) ;
            $product_item->product_item_name          = $request->product_item_name;
            $product_item->slug                       = Str::slug($request->product_item_name);
            $product_item->product_sub_category_id    = $request->product_sub_category;
            $product_item->product_item_description   = $request->product_item_description;
            $product_item->new_arrival                = $request->has('new_arrival') ? 1 : 0;
            $product_item->popular                    = $request->has('popular') ? 1 : 0;
            if($request->hasFile('image'))
            {
                $path           = 'images/product_items/'.$id.'/';
                @unlink($product_item->image);
                if (!is_dir($path))
                {
                    mkdir($path, 0755, true);
                }



                $image              = $request->image;
                $imageName          = $image->getClientOriginalName();

                $image->move($path,$imageName);
                $product_item->image           = $path.$imageName;
            }

            $product_item->save();
            DB::commit();
            $notification = array('message' => 'Product Item updated successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.productitems.index')->with($notification);

        } catch (\Exception $e) {
            DB::rollback();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.productitems.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $product_info = ProductInfo::where('product_item_id', $id)->first();
            if($product_info)
            {
                $notification = array('message' => 'Product info deleted first', 'alert-type'=> 'error');

                return redirect()->route('admin.productitems.index')->with($notification);
            }
            $product_item = ProductItem::where('product_item_id', $id)->firstOrFail();

            @unlink($product_item->image);
            $product_item->delete();

            DB::commit();
            $notification = array('message' => 'Product Item deleted successfully', 'alert-type'=> 'success');

            return redirect()->route('admin.productitems.index')->with($notification);
        } catch (\Exception $e) {

            DB::rollback();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.productitems.index')->with($notification);
        }
    }
}
