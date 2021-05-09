<?php

namespace App\Http\Controllers;

use App\Models\ProductInfo;
use Illuminate\Http\Request;

class OutOfStockController extends Controller
{
    public function index(){
        $product_infos = ProductInfo::with('productItem','productWeight')
                                        ->where('product_quantity', 0)
                                        ->get();
        // return $product_infos;
        return view('backend.stocks.out_of_stock',compact('product_infos'));

    }
}
