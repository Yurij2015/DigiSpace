<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WidgetIcon extends Model
{
    use HasFactory;

    public function widget(): BelongsTo
    {
        return $this->belongsTo(Widget::class);
    }
}
