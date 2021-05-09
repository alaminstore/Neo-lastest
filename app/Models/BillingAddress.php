<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;

    protected $primaryKey= 'billing_address_id';

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id')->withDefault();
    }
}
