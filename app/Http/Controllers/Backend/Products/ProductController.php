<?php

namespace App\Http\Controllers\Backend\Products;

use App\Attribute;
use App\AttributeProduct;
use App\AttributeValue;
use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\ImageGallery;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function unlink;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category','subcategory')->get();

        return view('backend.products.products.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories         = Category::orderBy('category_name', 'ASC')->get();
        $subcategories      = SubCategory::orderBy('name', 'ASC')->get();
        $brands             = Brand::get();
        $attributes         = Attribute::orderBy('name', 'asc')->get();
        $attributeValues    = AttributeValue::orderBy('name', 'asc')->get();
        $colors              = Attribute::with('attributeValues')->where('slug', 'color')->first();
        return view('backend.products.products.product_create',compact('categories', 'subcategories','brands', 'attributes', 'attributeValues', 'colors'));
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
            'name'          => 'required | string | max:255',
            'status'        => 'required',
            'category'      => 'required',
            'subcategory'   => 'required',
            'regular_price' => 'required | numeric',
            'sales_price' => 'nullable | numeric',
        ]);
        DB::beginTransaction();
        try {
            $product                    = new Product;
            $product->name              = $request->name;
            $product->description       = $request->description;
            $product->short_description = $request->short_description;
            $product->regular_price     = $request->regular_price;
            $product->sales_price       = $request->sales_price;
            $product->discount_percent  = $this->percentCount($request->regular_price, $request->sales_price);;
            $product->quantity          = $request->quantity;
            $product->category_id       = $request->category;
            $product->sub_category_id   = $request->subcategory;
            $product->attribute_value_id= $request->color;
            $product->brand_id          = $request->brand;
            $product->sku               = $request->sku;
            $product->status            = $request->status;
            $product->save();

            if($request->has('attribute_id') && $request->has('attribute_value_id'))
            {

                foreach ($request->attribute_id as $key => $attribute) {

                    $attributes = array(
                        'attribute_id' => $attribute,
                        'product_id' => $product->id,
                        'attribute_value_id' => $request->attribute_value_id[$key],
                    );
                    AttributeProduct::create($attributes);
                }
            }


            if($request->hasFile('image'))
            {
                $path           = 'uploads/products/'.$product->id.'/';

                if (!is_dir($path))
                {
                    mkdir($path, 0755, true);
                }

                $product_image      = Product::find($product->id);

                $image              = $request->image;
                $imageName          = rand(100,1000).$image->getClientOriginalName();

                $image->move($path,$imageName);
                $product_image->image           = $path.$imageName;
                $product_image->save();
            }


            if($request->hasFile('gallery_image'))
            {
                $path           = 'uploads/products/'.$product->id.'/';

                if (!is_dir($path))
                {
                    mkdir($path, 0755, true);
                }

                foreach ($request->gallery_image as $image) {
                    $image                          = $image;
                    $imageName                      = rand(1000,15000).$image->getClientOriginalName();
                    $product_image                  = new ImageGallery;
                    $image->move($path,$imageName);
                    $product_image->product_id      = $product->id;
                    $product_image->image           = $path.$imageName;
                    $product_image->save();
                }
            }

            DB::commit();
            $notification = array('message' => 'Product Created successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.products.index')->with($notification);

        } catch (\Exception $e) {
            DB::rollback();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.products.index')->with($notification);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $categories         = Category::orderBy('category_name', 'ASC')->get();
        $subcategories      = SubCategory::orderBy('name', 'ASC')->get();
        $brands             = Brand::get();
        $attributes         = Attribute::orderBy('name', 'asc')->get();
        $attributeValues    = AttributeValue::orderBy('name', 'asc')->get();
        $colors              = Attribute::with('attributeValues')->where('slug', 'color')->first();
        $imageGalleries     = ImageGallery::where('product_id',$product->id)->get();
        $productAttributes  = AttributeProduct::where('product_id',$product->id)->get();
//        dd($color);
        return view('backend.products.products.product_edit',compact('categories', 'subcategories','brands', 'attributes', 'attributeValues', 'imageGalleries', 'product', 'productAttributes', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
//        dd($request);
        $request->validate([
            'name'       => 'required | string | max:255',
            'category'      => 'required',
            'subcategory'   => 'required',
            'status'     => 'required',
            'regular_price' => 'required | numeric',
            'sales_price' => 'nullable | numeric',
        ]);
        DB::beginTransaction();
        try {
            $product_upadate                        = Product::find($product->id);
            $product_upadate->name                  = $request->name;
            $product_upadate->slug                  = Str::slug($request->name);
            $product_upadate->description           = $request->description;
            $product_upadate->short_description     = $request->short_description;
            $product_upadate->regular_price         = $request->regular_price;
            $product_upadate->sales_price           = $request->sales_price;
            $product_upadate->discount_percent      = $this->percentCount($request->regular_price, $request->sales_price);
            $product_upadate->quantity              = $request->quantity;
            $product_upadate->category_id           = $request->category;
            $product_upadate->sub_category_id       = $request->subcategory;
            $product_upadate->brand_id              = $request->brand;
            $product_upadate->attribute_value_id    = $request->color;
            $product_upadate->status                = $request->status;
            $product_upadate->sku                   = $request->sku;
            $product_upadate->save();

            if($request->has('attribute_id') && $request->has('attribute_value_id'))
            {
                AttributeProduct::where('product_id', $product->id)->delete();

                foreach ($request->attribute_id as $key => $attribute) {
                    $attributes = array(
                        'attribute_id' => $attribute,
                        'product_id' => $product->id,
                        'attribute_value_id' => $request->attribute_value_id[$key],
                    );
                    AttributeProduct::create($attributes);
                }
            }


            if($request->hasFile('image'))
            {
                $path           = 'uploads/products/'.$product->id.'/';

                if (!is_dir($path))
                {
                    mkdir($path, 0755, true);
                }

                $product_image      = Product::find($product->id);
                @unlink($product_image->image);
                $image              = $request->image;
                $imageName          = rand(100,1000).$image->getClientOriginalName();

                $image->move($path,$imageName);
                $product_image->image           = $path.$imageName;
                $product_image->save();
            }


            if($request->hasFile('gallery_image'))
            {
                $path           = 'uploads/products/'.$product->id.'/';

                if (!is_dir($path))
                {
                    mkdir($path, 0755, true);
                }

                foreach ($request->gallery_image as $image) {
                    $image                          = $image;
                    $imageName                      = rand(1000,15000).$image->getClientOriginalName();
                    $product_image                  = new ImageGallery;
                    $image->move($path,$imageName);
                    $product_image->product_id      = $product->id;
                    $product_image->image           = $path.$imageName;
                    $product_image->save();
                }
            }

            DB::commit();
            $notification = array('message' => 'Product updated successfully', 'alert-type'=> 'success');

            return redirect()->route('admin.products.index')->with($notification);
        } catch (\Exception $e) {

            DB::rollback();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.products.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {

            AttributeProduct::where('product_id', $product->id)->delete();

            $images = ImageGallery::where('product_id',$product->id)->get();

            foreach ($images as $key => $image)
            {
                @unlink($image->image);
                $image->delete();
            }

            @unlink($product->image);
            $product->delete();

            DB::commit();
            $notification = array('message' => 'Product Deleted successfully', 'alert-type'=> 'success');

            return redirect()->route('admin.products.index')->with($notification);
        } catch (\Exception $e) {

            DB::rollback();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('admin.products.index')->with($notification);
        }

    }

    public function productImageDelete($id)
    {
        $productImage = Product::findOrFail($id);
        @unlink($productImage->image);
        $productImage->image         = '';
        if($productImage->save())
        {
            $notification = array('message' => 'Product Image deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
        }
        return response()->json($notification);
    }

    public function imageGalleryDelete($id)
    {
        $imageGallery = ImageGallery::findOrFail($id);
        @unlink($imageGallery->image);
        $imageGallery->delete();
        $notification = array('message' => 'Gallery Image deleted successfully', 'alert-type'=> 'success');
        return response()->json($notification);
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
