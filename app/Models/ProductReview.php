<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_review_id';

    public function ProductItem()
    {
        return $this->belongsTo(ProductItem::class, 'product_item_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
    public function reply()
    {
        return $this->belongsTo(User::class, 'reply_id')->withDefault();
    }
}
