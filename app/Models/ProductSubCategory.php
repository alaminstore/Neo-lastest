<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_sub_category_id';

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id')->withDefault();
    }

    public function productItems()
    {
        return $this->hasMany(ProductItem::class,'product_sub_category_id', 'product_sub_category_id');
    }
}
