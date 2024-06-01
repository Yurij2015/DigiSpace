<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'details', 'price', 'service_category_id', 'seo_keywords', 'seo_description', 'seo_title', 'image_alt', 'description', 'slug', 'image',
    ];
}
