<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }

    public function billing()
    {
        return $this->belongsTo(BillingAddress::class,'billing_address_billing_address_id')->withDefault();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

}
