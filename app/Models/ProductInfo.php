<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_info_id';

    public function productWeight()
    {
        return $this->belongsTo(ProductWeight::class, 'product_weight_id')->withDefault();
    }

    public function productInfoWeights()
    {
        return $this->hasMany(ProductWeight::class, 'product_weight_id');
    }

    public function productItem()
    {
        return $this->belongsTo(ProductItem::class, 'product_item_id')->withDefault();
    }
    
}
