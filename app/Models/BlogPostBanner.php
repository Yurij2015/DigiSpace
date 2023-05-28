<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogPostBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_path', 'blog_page_type', 'post_id', 'alt', 'url'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
