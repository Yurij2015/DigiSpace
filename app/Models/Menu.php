<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'level', 'position', 'description', 'location', 'slug', 'href'
    ];

    public function menuItem(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
