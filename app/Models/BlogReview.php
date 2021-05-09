<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogReview extends Model
{
    use HasFactory;

    protected $primaryKey = 'blog_review_id';

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function replyUser()
    {
        return $this->belongsTo(User::class, 'reply_id')->withDefault();
    }
}
