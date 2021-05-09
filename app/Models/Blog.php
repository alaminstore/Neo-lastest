<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $primaryKey = 'blog_id';

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class,'blog_category_id');
    }

    public function blogReview()
    {
        return $this->hasMany(BlogReview::class, 'blog_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}
