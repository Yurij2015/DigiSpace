<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Str;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'seo_keywords', 'seo_description', 'seo_title', 'slug'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::updating(static function ($serviceCategory) {
            $serviceCategory->slug = Str::slug($serviceCategory->name);
        });

        static::creating(static function ($serviceCategory) {
            $serviceCategory->slug = Str::slug($serviceCategory->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function service(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
