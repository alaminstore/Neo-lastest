<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'faq_category_id';

    public function faqAll()
    {
        return $this->hasMany(Faq::class, 'faq_category_id');
    }
}
