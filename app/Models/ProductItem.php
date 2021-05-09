<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_item_id';

    public function subCategoriy()
    {
        return $this->belongsTo(ProductSubCategory::class,'product_sub_category_id')->withDefault();
    }

    public function ProductInfos()
    {
        return $this->hasMany(ProductInfo::class, 'product_item_id');
    }

    public function ProductCategory()
    {
        return $this->belongsTo(ProductSubCategory::class,'product_sub_category_id')
                    ->rightJoin('product_categories', 'product_categories.product_category_id', 'product_sub_categories.product_category_id');
    }
}
