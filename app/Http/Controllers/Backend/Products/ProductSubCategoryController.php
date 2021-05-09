<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = ProductSubCategory::with('productCategory')->get();
        $categories     = ProductCategory::orderBy('product_category_name','ASC')->get();
//        dd($sub_categories);
        return view('backend.products.sub_categories.sub_categories', compact('sub_categories', 'categories'));
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
            'product_category'   => 'required | integer',
            'product_sub_category_name' => ['required', 'string' ,'max:200', function($attribute, $value, $fail) use ($request){
                if(ProductSubCategory::where('product_category_id', $request->product_category)->where('product_sub_category_name', $request->product_sub_category_name)->count())
                {
                    return $fail('subcategory already exists.');
                }
            }],
        ]);

        $sub_category                               = new ProductSubCategory;
        $sub_category->product_category_id          = $request->product_category;
        $sub_category->product_sub_category_name    = $request->product_sub_category_name;
        $sub_category->slug                         = Str::slug($request->product_sub_category_name);
        if($sub_category->save())
        {
            $notification = array('message' => 'Subcategory added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.subcategories.index')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductSubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_category  = ProductSubCategory::findOrFail($id);
        return response()->json($sub_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductSubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $request->validate([
            'product_category'   => ['required', 'integer'],
            'product_sub_category'   => ['required', 'integer'],
            'product_sub_category_name' => ['required', 'string' ,'max:200', function($attribute, $value, $fail) use ($request) {
                if (ProductSubCategory::where('product_category_id', $request->product_category)->where('product_sub_category_name', $request->product_sub_category_name)->where('product_sub_category_id', '!=', $request->product_sub_category)->count()) {
                    return $fail('subcategory already exists.');
                }
            }],
        ]);

        $sub_category                               = ProductSubCategory::find($request->product_sub_category);
        $sub_category->product_category_id          = $request->product_category;
        $sub_category->product_sub_category_name    = $request->product_sub_category_name;
        $sub_category->slug                         = Str::slug($request->product_sub_category_name);
        if($sub_category->save())
        {
            $notification = array('message' => 'Subcategory updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.subcategories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductSubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_category        = ProductSubCategory::findOrFail($id);
        $sub_category_exist  = Discount::where('product_sub_category_id',$id)->first();

        if($sub_category_exist)
        {
            $notification        = array('message' => 'Please first remove this subcategory from Discount.', 'alert-type'=> 'error');
            return redirect()->route('admin.subcategories.index')->with($notification);
        }

        if($sub_category->delete())
        {
            $notification = array('message' => 'Subcategories deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.subcategories.index')->with($notification);
    }

    public function subcategories($category_id)
    {
        $subcategories = ProductSubCategory::where('category_id', $category_id)->orderBy('name','ASC')->get();
        return response()->json($subcategories);
    }
}
