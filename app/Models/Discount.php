<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $primaryKey = 'discount_id';

    public function ProductSubcategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'product_sub_category_id');
    }
}
