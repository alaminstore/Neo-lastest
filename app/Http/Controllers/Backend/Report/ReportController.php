<?php

namespace App\Http\Controllers\Backend\Report;

use App\City;
use App\Http\Controllers\Controller;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function areaWiseSales()
    {
        request()->validate([
            'from'  =>  'nullable|date',
            'to'    =>  'nullable|date|after_or_equal:from'
        ]);
        $area_wise_sales = [];
        $from           = date('Y-m-d', strtotime(request('from'))) != '1970-01-01' ? date('Y-m-d', strtotime(request('from'))) : date('Y-m-d', strtotime('-1 months'));
        $to             = date('Y-m-d', strtotime(request('to'))) != '1970-01-01' ?  date('Y-m-d', strtotime(request('to'))) : date('Y-m-d');
        $product        = request('product_id') != null ? Product::findOrFail(request('product_id'))->id : '';

        if($product)
        {
            $area_wise_sales     = OrderDetail::with('city')
                                    ->groupBy('order_details.city_id')
                                    ->select('city_id',DB::raw('SUM(order_details.quantity) as quantity'), 'order_details.product_id', DB::raw('SUM(order_details.sub_total) as sales_total'))
                                    ->when($product, function ($query) use ($product){
                                        $query->where('order_details.product_id', $product);
                                    })
                                    ->when($from, function ($query) use ($from){
                                        $query->where('order_details.created_at', '>=',$from);
                                    })
                                    ->when($to, function ($query) use ($to){
                                        $query->where('order_details.created_at', '<=',$to);
                                    })
                                    ->orderBy('quantity', 'desc')
                                    ->get();
        }


        $products = Product::orderBy('name','ASC')->get();
        return view('backend.reports.area_wise_sales', compact('products', 'area_wise_sales'));
    }
}
