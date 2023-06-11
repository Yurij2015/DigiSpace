<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Str;

class Page extends Model
{
    protected $fillable = [
        'name', 'content', 'meta', 'description', 'slug', 'page_category_id', 'menu_item_id'
    ];

    public function widgets(): BelongsToMany
    {
        return $this->belongsToMany(Widget::class);
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function pageCategory(): BelongsTo
    {
        return $this->belongsTo(PageCategory::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::updating(static function ($page) {
            $page->slug = Str::slug($page->name);
        });

        static::creating(static function ($page) {
            $page->slug = Str::slug($page->name);
        });
    }
}
