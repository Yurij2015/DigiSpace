<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Widget extends Model
{
    use HasFactory;

    public function widgetCategory(): BelongsTo
    {
        return $this->belongsTo(WidgetCategory::class);
    }
}
