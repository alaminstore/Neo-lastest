<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_category_id';

    public function subcategories()
    {
        return $this->hasMany(ProductSubCategory::class,'product_category_id')->orderBy('product_sub_category_name', 'ASC');
    }

}
