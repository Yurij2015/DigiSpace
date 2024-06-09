<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'details', 'price', 'service_category_id', 'seo_keywords', 'seo_description', 'seo_title', 'image_alt', 'description', 'slug', 'image', 'status'
    ];

    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: static fn($value) => $value ? '/uploads/' . $value : '/uploads/no_image.png'
        );
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
