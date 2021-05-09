<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = "order_item_id";

    public function productInfo()
    {
        return $this->belongsTo(ProductInfo::class,'product_info_product_info_id', 'product_info_id')->withDefault();
    }
}
