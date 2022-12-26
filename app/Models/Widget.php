<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Widget extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'subtitle', 'widget_category_id', 'icon', 'widget_image'
    ];

    public function widgetCategory(): BelongsTo
    {
        return $this->belongsTo(WidgetCategory::class);
    }

    /**
     * Get the img_path correct path.
     *
     * @return Attribute
     */
    protected function widgetImage(): Attribute
    {
        return Attribute::make(
            get: static fn($value) => url('uploads/widgets/' . $value),
        );
    }

    public function widgetIcon(): HasMany
    {
        return $this->hasMany(WidgetIcon::class);
    }
}
