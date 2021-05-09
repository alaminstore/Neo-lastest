<?php

namespace App\Http\Controllers\Backend\Stock;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use function redirect;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Product::where('quantity' ,'<' ,20)->get();

        return view('backend.stocks.stocks', compact('stocks'));
    }

    public function stockEdit($id)
    {
        $stocks = Product::where('id', $id)
                        ->where('quantity' ,'<' ,20)
                        ->first();
        return response()->json($stocks);
    }

    public function stockUpdate(Request $request)
    {
        $request->validate([
           'quantity' => 'required | numeric',
           'product_id' => 'required | numeric',
        ]);

        $update = Product::where('id', $request->product_id)->update(['quantity' => $request->quantity]);
        if($update)
        {
            $notification = array('message' => 'Stock updated successfully', 'alert-type'=> 'success');
            return redirect()->route('admin.stocks')->with($notification);
        }
        else
        {
            $notification = array('message' => 'Something went wrong!', 'alert-type'=> 'success');
            return redirect()->route('admin.stocks')->with($notification);
        }
    }
}
