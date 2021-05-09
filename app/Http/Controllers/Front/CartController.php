<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use App\Models\AttributeProduct;
use App\Models\Discount;
use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\ProductInfo;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        return view('front.cart.cart');
    }

    public function addToCart(Request $request)
    {

        $request->validate([
            'quantity'        => 'required | integer| min:0',
            'product_info'    => 'required | integer',
        ]);
        $quantity           = $request->quantity;
        $product_id         = $request->product_info;
        $cart_add           = true;
        $rowId              = '';
        $discount_percentage = 0;
        $discount_id         = 0;
        $product            = ProductInfo::with('productWeight','productItem')
                                        ->where('product_info_id', $product_id)
                                        ->firstOrFail();
        $discount           = Discount::where('active',1)->orderBy('discount_id', 'desc')->where('product_sub_category_id', $product->productItem->product_sub_category_id)->first();

        if($discount)
        {
            $discount_percentage = $discount->discount_percentage;
            $discount_id         = $discount->discount_id;
        }

        DB::beginTransaction();
        try{

            if(Cart::count())
            {

                foreach (Cart::content() as $item) {
                    if($product->product_quantity < ($quantity+$item->qty))
                    {
                        $cart_add = false;
                        $notification = array('message' => 'Product has no enough quantity!', 'alert-type'=> 'error');
                        return response()->json(['product' => $product, 'notification' => $notification, 'cart_add' => $cart_add,'discount' => $discount]);
                    }
                    if($item->id == $product->product_info_id)
                    {
                        $rowId = $item->rowId;
                    }
                }

                if($rowId)
                {
                    Cart::update($rowId, $request->quantity, $discount_percentage, $discount_id);
                    $carts          = Cart::content();
                    $sub_total      = Cart::subtotal();
                    $auth_check     = Auth::check();
                    DB::commit();
                    $notification = array('message' => 'Cart updated successfully', 'alert-type'=> 'success');
                    return response()->json([
                        'product' => $product,
                        'notification' => $notification,
                        'carts' => $carts,
                        'sub_total' => $sub_total,
                        'auth_check' =>  $auth_check,
                        'cart_add' => $cart_add,
                        'discount' => $discount
                    ]);
                }
                else
                {
                    if($product->product_quantity < $quantity)
                    {
                        $cart_add = false;
                        $notification = array('message' => 'Product has no enough quantity!', 'alert-type'=> 'error');
                        return response()->json(['notification' => $notification, 'cart_add' => $cart_add]);
                    }
                    $this->cartCall($product, $quantity, $discount_percentage, $discount_id);

                    $carts          = Cart::content();
                    $sub_total      = Cart::subtotal();
                    $auth_check     = Auth::check();
                    DB::commit();
                    $notification = array('message' => 'Product added cart successfully', 'alert-type'=> 'success');
                    return response()->json([
                        'product'       => $product,
                        'notification'  => $notification,
                        'carts'         => $carts,
                        'sub_total'     => $sub_total,
                        'auth_check'    =>  $auth_check,
                        'cart_add'      => $cart_add,
                        'discount'      => $discount
                    ]);
                }
            }
            else
            {
                if($product->product_quantity < $quantity)
                {
                    $cart_add = false;
                    $notification = array('message' => 'Product has no enough quantity!', 'alert-type'=> 'error');
                    return response()->json(['notification' => $notification, 'cart_add' => $cart_add]);
                }
                $this->cartCall($product, $quantity, $discount_percentage, $discount_id);

                $carts          = Cart::content();
                $sub_total      = Cart::subtotal();
                $auth_check     = Auth::check();
                $notification = array('message' => 'Product added cart successfully', 'alert-type'=> 'success');
                return response()->json([
                    'product'       => $product,
                    'notification'  => $notification,
                    'carts'         => $carts,
                    'sub_total'     => $sub_total,
                    'auth_check'    =>  $auth_check,
                    'cart_add'      => $cart_add,
                    'discount'      => $discount
                ]);
            }
         }catch(\Exception $e){
            DB::rollBack();
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'error');
            return redirect()->route('cart')->with($notification);
        }
    }

    public function cartUpdate(Request $request)
    {
        $request->validate([
            'quantity'  => 'required',
            'rowid'     => 'required',
        ]);
        $exist        = false;
        $row_id_check = Cart::content()->all();
        $item         = '';
        foreach ($row_id_check as $check)
        {
            if(strpos($check->rowId , $request->rowid) !== false)
            {
                $exist = true;
                break;
            }
        }

        if($exist)
        {
            Cart::update($request->rowid, $request->quantity);
            $item = Cart::get($request->rowid);
            $notification = array('message' => 'Cart quantity updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went worng!', 'alert-type'=> 'error');
        }
        return response()->json([
            'total'         => Cart::total(),
            'sub_total'     => Cart::subtotal(),
            'rowid'         => $request->rowid,
            'notification'  => $notification,
            'exist'         => $exist,
            'item'          => $item
        ]);
    }

    public function cartRemove($rowid)
    {
        $exist = false;
        $row_id_check = Cart::content()->all();
        foreach ($row_id_check as $check)
        {
            if(strpos($check->rowId , $rowid) !== false)
            {
                $exist = true;
                break;
            }
        }

        if($exist)
        {
            Cart::remove($rowid);
            $notification = array('message' => 'Removed from cart successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Something went worng!', 'alert-type'=> 'error');

        }

        return response()->json([
            'total'         => Cart::total(),
            'sub_total'     => Cart::subtotal(),
            'rowid'         => $rowid,
            'notification'  => $notification,
            'exist'         => $exist]);
    }

    public function cartCount()
    {
        $count = Cart::count();
        return response()->json($count);
    }

    public function productCartCount($product_info_id)
    {
        $count = 0;
        if(Cart::count())
        {
            foreach (Cart::content() as $cart)
            {
                if($cart->id == $product_info_id)
                {
                    $count = $cart->qty;
                }
            }
        }
        return response()->json($count);
    }

    private function cartCall($product, $quantity, $discount_percentage, $discount_id)
    {
        $data['id']                                 = $product->product_info_id;
        $data['name']                               = $product->productItem->product_item_name;
        $data['qty']                                = $quantity;
        $data['price']                              = $discount_percentage == 0 ? $product->sales_price ?? $product->price : ($product->sales_price ?? $product->price) - (($product->sales_price ?? $product->price) * $discount_percentage/100) ;
        $data['weight']                             = $product->productWeight->weight;
        $data['options']['image']                   = $product->productItem->image;
        $data['options']['weight_unit']             = $product->productWeight->weight_unit;
        $data['options']['discount_id']             = $discount_id;

        Cart::add($data);
    }

    private function cartNotAddedCheckQuantity($product,$quantity)
    {
        if($product->product_quantity < $quantity)
        {
            $cart_add = false;
            $notification = array('message' => 'Product has no enough quantity!', 'alert-type'=> 'error');
            return response()->json(['notification' => $notification, 'cart_add' => $cart_add]);
        }
    }
}
