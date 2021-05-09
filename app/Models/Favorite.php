<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $primaryKey = 'favorite_id';

    public function productInfo()
    {
        return $this->belongsTo(ProductInfo::class, 'product_info_id')
            ->with('productItem')
            ->withDefault();
    }
}
