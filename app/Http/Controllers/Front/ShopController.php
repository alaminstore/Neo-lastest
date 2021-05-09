<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\ProductInfo;
use App\Models\ProductItem;
use App\Models\ProductReview;
use App\Models\Review;
use App\Models\Shopbanner;
use App\Models\SubCategory;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ShopController extends Controller
{
    public function shop()
    {
        $banner = Shopbanner::get();

        $paginationShow = \request()->input('perpageshow') ?
            (\request()->input('perpageshow') ==  16 || \request()->input('perpageshow') ==   20
                ? \request()->input('perpageshow')
                : 12 )
            : 12;
        $orderBy = request()->query('orderby');

        $products   = ProductItem::join('product_infos','product_infos.product_item_id', 'product_items.product_item_id')
                                    ->select('product_items.*')
                                    ->groupBy('product_infos.product_item_id')
                                    ->when(request()->input('show') == 'newarrival', function ($query){
                                        return $query->where('product_items.new_arrival', 1);
                                    })
                                    ->when(request()->input('show') == 'discount', function ($query){
                                        return $query->where('product_infos.percent', '>=', 1);
                                    })
                                    ->when(request()->input('show') == 'popular', function ($query){
                                        return $query->where('product_items.popular', 1);
                                    })
                                    ->when(request()->input('orderby') == 'popularity', function ($query){
                                        return $query->where('product_items.popular', 1)
                                            ->orderBy('product_items.product_item_name', 'asc');
                                    })
                                    ->when(request()->input('orderby') == 'date', function ($query){
                                        return $query->orderBy('product_items.created_at', 'desc');
                                    })
                                    ->when(request()->input('orderby') == 'price', function ($query){
                                        return $query->orderBy('product_infos.price', 'asc');
                                    })
                                    ->when(request()->input('orderby') == 'pricedesc', function ($query){
                                        return $query->orderBy('product_infos.price', 'desc');
                                    })
                                    ->when(request()->input('orderby') == null, function ($query){
                                        return $query->orderBy('product_items.created_at', 'desc');
                                    })
                                  ->paginate($paginationShow);

        $product_info_min_price  = [];
        $product_infos           = [];
        foreach ($products as $product)
        {
            $product_info_min_price[$product->product_item_id] = ProductInfo::where('product_item_id', $product->product_item_id)
                                                                            ->get()
                                                                            ->min('price');
            $product_infos[$product->product_item_id]          = ProductInfo::with('productWeight')
                                                                            ->where('product_item_id', $product->product_item_id)
                                                                            ->get();
        }

        return view('front.shop.shop',compact('products', 'product_info_min_price','product_infos','banner'));
    }

    public function shopSingle($id)
    {
        $product_popularity = ProductItem::Find($id);
        $product_popularity->popular_count +=1;
        $product_popularity->save();

        $product   = ProductItem::with('ProductCategory')
                                ->join('product_infos','product_infos.product_item_id', 'product_items.product_item_id')
                                ->select('product_items.*')
                                ->groupBy('product_infos.product_item_id')
                                ->where('product_items.product_item_id', $id)
                                ->firstOrFail();

        $product_infos          = ProductInfo::with('productWeight')
                                            ->where('product_item_id', $id)
                                            ->get();
        $product_info_min_price = $product_infos->min('price');
        $product_infos_id = $product_infos->map(function ($item){
            return $item->product_info_id;
        });
        $reviews                      = ProductReview::with('user','reply')
                                            ->where('product_item_id', $id)
                                            ->where('status', 1)
                                            ->orderBy('product_review_id', 'desc')
                                            ->paginate(5);
        $favorites = [];
        if(Auth::user())
        {
            $favorites               = Favorite::where('favorites.user_id', Auth::user()->user_id)
                                                ->whereIn('favorites.product_info_id', $product_infos_id)
                                                ->get();
        }
        $cart_quantity_count        = $this->cartQuantity($product_infos,$product_info_min_price);

        $related_products           = ProductItem::join('product_infos','product_infos.product_item_id', 'product_items.product_item_id')
                                                ->select('product_items.*')
                                                ->where('product_items.new_arrival', 1)
                                                ->where('product_items.product_item_id', '!=',$product->product_item_id)
                                                ->where('product_items.product_sub_category_id', $product->ProductCategory->product_sub_category_id)
                                                ->groupBy('product_infos.product_item_id')
                                                ->get()
                                                ->take(6);


        $new_arrival_product_info_min_price = $this->productMinInfo($related_products);
        $new_arrival_product_infos          = $this->productInfos($related_products);

        return view('front.shop.single_shop',
            compact('product', 'product_infos', 'product_info_min_price', 'reviews', 'favorites', 'cart_quantity_count', 'related_products', 'new_arrival_product_info_min_price', 'new_arrival_product_infos')
        );
    }

    public function shopQuickView($id)
    {
        $product   = ProductItem::with('ProductCategory')
                                ->join('product_infos','product_infos.product_item_id', 'product_items.product_item_id')
                                ->select('product_items.*')
                                ->groupBy('product_infos.product_item_id')
                                ->where('product_items.product_item_id', $id)
                                ->firstOrFail();

        $product_infos = ProductInfo::with('productWeight')->where('product_item_id', $id)->get();

        $product_info_min_price = ProductInfo::where('product_item_id', $id)->get()->min('price');

        $cart_quantity_count = $this->cartQuantity($product_infos,$product_info_min_price);

        return response()->json([
            'product'                   => $product,
            'product_infos'             => $product_infos,
            'product_info_min_price'    => $product_info_min_price,
            'cart_quantity_count'       => $cart_quantity_count
        ]);
    }

    public function shopProductInfo($id)
    {
        $product_info = ProductInfo::where('product_info_id', $id)
                                    ->select('product_info_id', 'product_quantity', 'price', 'sales_price')
                                    ->firstOrFail();

        $cart_quantity_count = 0;
        foreach (Cart::content() as $cart)
        {
            if($cart->id == $id)
            {
                $cart_quantity_count = $cart->qty;
            }
        }

        return response()->json([
            'product_info' => $product_info,
            'cart_quantity_count' => $cart_quantity_count
        ]);
    }

    public function cartQuantity($product_infos,$product_info_min_price)
    {
        $cart_quantity_count = 0;
        $product_info_id = '';
        if(Cart::count())
        {
            foreach ($product_infos as $product_info)
            {
                if($product_info->price == $product_info_min_price)
                {
                    $product_info_id = $product_info->product_info_id;
                }
            }
            if($product_info_id)
            {
                foreach (Cart::content() as $cart)
                {
                    if($cart->id == $product_info_id)
                    {
                        $cart_quantity_count = $cart->qty;
                    }
                }
            }

        }
        return $cart_quantity_count;
    }

    public function liveSearch(Request $request)
    {
        $products   = ProductItem::join('product_infos','product_infos.product_item_id', 'product_items.product_item_id')
                                    ->select('product_items.product_item_id', 'product_items.product_item_name','product_items.slug',
                                        'product_items.image')
                                    ->groupBy('product_infos.product_item_id')
                                    ->where('product_items.product_item_name','Like', '%'.$request->search.'%')
                                    ->get();
        $product_infos          = $this->searchProductInfos($products);
        return response()->json(['products' => $products,'product_infos' => $product_infos]);
    }

    public function productMinInfo($products)
    {
        $product_info_min_price  = [];
        foreach ($products as $product)
        {
            $product_info_min_price[$product->product_item_id] = ProductInfo::where('product_item_id', $product->product_item_id)
                ->get()
                ->min('price');
        }
        return $product_info_min_price;
    }

    public function productInfos($products)
    {
        $product_infos           = [];
        foreach ($products as $product)
        {
            $product_infos[$product->product_item_id]          = ProductInfo::with('productWeight')
                ->where('product_item_id', $product->product_item_id)
                ->get();
        }
        return $product_infos;
    }

    public function searchProductInfos($products)
    {
        $product_infos           = [];
        foreach ($products as $product)
        {
            $product_info_min_price = ProductInfo::where('product_item_id', $product->product_item_id)
                                                ->get()
                                                ->min('price');

            $product_infos[$product->product_item_id]  = ProductInfo::select('product_info_id','price','sales_price','product_item_id')
                                                                ->where('product_item_id', $product->product_item_id)
                                                                ->where('price',$product_info_min_price)
                                                                ->first();
        }
        return $product_infos;
    }


    public function productRating(Request $request){
        $product_info = ProductItem::find($request->product_id);
        $total = ($product_info->five+$product_info->four+$product_info->three+$product_info->two+$product_info->one)+1;
        $all_star =$product_info->total = $total;
        if($request->rating == 5){
             $five = $product_info->five+=1;
            //  return $five;
            $rating = (5*$five+ 4*$product_info->four+3*$product_info->three+2*$product_info->two+1*$product_info->one)/$all_star;
            $product_info->five = $five;
            $product_info->total = $total;
            $product_info->product_rating = $rating;
            $product_info->save();
            $notification = array('message' => 'Your rating added successfully', 'alert-type'=> 'success');
            return Redirect::back()->with($notification);
        }
        if($request->rating == 4){
            $four = $product_info->four+=1;
            $rating = (5*$product_info->five+ 4*$four+3*$product_info->three+2*$product_info->two+1*$product_info->one)/$all_star;
            $product_info->four = $four;
            $product_info->total = $total;
            $product_info->product_rating = $rating;
            $product_info->save();
            $notification = array('message' => 'Your rating added successfully', 'alert-type'=> 'success');
            return Redirect::back()->with($notification);
        }
        if($request->rating == 3){
            $three = $product_info->three+=1;
            $rating = (5*$product_info->five+ 4*$product_info->four+3*$three+2*$product_info->two+1*$product_info->one)/$all_star;
            $product_info->three = $three;
            $product_info->total = $total;
            $product_info->product_rating = $rating;
            $product_info->save();
            $notification = array('message' => 'Your rating added successfully', 'alert-type'=> 'success');
            return Redirect::back()->with($notification);
        }
        if($request->rating == 2){
            $two = $product_info->two+=1;
            $rating = (5*$product_info->five+ 4*$product_info->four+3*$product_info->three+2*$two+1*$product_info->one)/$all_star;
            $product_info->two = $two;
            $product_info->total = $total;
            $product_info->product_rating = $rating;
            $product_info->save();
            $notification = array('message' => 'Your rating added successfully', 'alert-type'=> 'success');
            return Redirect::back()->with($notification);
        }
        if($request->rating == 1){
            $one = $product_info->one+=1;
            $rating = (5*$product_info->five+ 4*$product_info->four+3*$product_info->three+2*$product_info->two+1*$one)/$all_star;
            $product_info->one = $one;
            $product_info->total = $total;
            $product_info->product_rating = $rating;
            $product_info->save();
            $notification = array('message' => 'Your rating added successfully', 'alert-type'=> 'success');
            return Redirect::back()->with($notification);
        }

    }


}
