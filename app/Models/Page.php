<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Page extends Model
{
    public function widgets(): BelongsToMany
    {
        return $this->belongsToMany(Widget::class);
    }
}
