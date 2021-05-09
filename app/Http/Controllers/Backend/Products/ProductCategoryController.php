<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::get();
        return view('backend.products.categories.categories', compact('categories'));
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
            'product_category_name' => 'required | string | max: 200  | unique:product_categories',
        ]);

        $category                           = new ProductCategory;
        $category->product_category_name    = $request->product_category_name;
        $category->slug                     = Str::slug($request->product_category_name);
        if($category->save())
        {
            $notification = array('message' => 'Product Category added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.categories.index')->with($notification);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category  = ProductCategory::find($id);
        return response()->json($category);
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
            'category_id' => 'required',
            'product_category_name' => ['required',  'string' , 'max: 200' ,Rule::unique('product_categories', 'product_category_name')->ignore($request->category_id, 'product_category_id')->where(function ($query) use ($request) {
                $query->where('product_category_name', $request->product_category_name);
            })],
        ]);

        $category                               = ProductCategory::findOrFail($request->category_id);
        $category->product_category_name        = $request->product_category_name;
        $category->slug                         = Str::slug($request->product_category_name);
        if($category->save())
        {
            $notification = array('message' => 'Product Category updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.categories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $category)
    {

        $category_exist  = ProductSubCategory::where('product_category_id', $category->product_category_id)->first();

        if($category_exist)
        {
            $notification        = array('message' => 'Please first remove from subcategory.', 'alert-type'=> 'error');
            return redirect()->route('admin.categories.index')->with($notification);
        }

        if($category->delete())
        {
            $notification = array('message' => 'Category deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.categories.index')->with($notification);
    }

}
