<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WidgetCategory extends Model
{
    use HasFactory;

    public function post(): HasMany
    {
        return $this->hasMany(Widget::class);
    }
}
