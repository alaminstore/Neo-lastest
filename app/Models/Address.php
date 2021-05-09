<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $primaryKey="district_id";
    protected  $guarded = [];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id')->withDefault();
    }
}
