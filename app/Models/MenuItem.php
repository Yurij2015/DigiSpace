<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $slug
 */
class MenuItem extends Model
{
    use HasFactory;

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }

    public function page(): HasMany
    {
        return $this->hasMany(Page::class);
    }
}
