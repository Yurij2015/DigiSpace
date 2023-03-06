<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
