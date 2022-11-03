<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'content', 'category_id', 'user_id', 'img_path'
    ];

    /**
     * Get the img_path correct path.
     *
     * @return Attribute
     */
    protected function imgPath(): Attribute
    {
        return Attribute::make(
            get: static fn($value) => url('uploads/' . $value),
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
