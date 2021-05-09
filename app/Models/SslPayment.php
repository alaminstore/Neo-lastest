<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SslPayment extends Model
{
    use HasFactory;

    protected $primaryKey = 'ssl_payment_id';
}
