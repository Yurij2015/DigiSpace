<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Str;

/**
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $seo_keywords
 * @property string|null $seo_description
 * @property string|null $seo_title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Service> $service
 * @property-read int|null $service_count
 * @method static Builder<static>|ServiceCategory newModelQuery()
 * @method static Builder<static>|ServiceCategory newQuery()
 * @method static Builder<static>|ServiceCategory query()
 * @method static Builder<static>|ServiceCategory whereCreatedAt($value)
 * @method static Builder<static>|ServiceCategory whereId($value)
 * @method static Builder<static>|ServiceCategory whereName($value)
 * @method static Builder<static>|ServiceCategory whereSeoDescription($value)
 * @method static Builder<static>|ServiceCategory whereSeoKeywords($value)
 * @method static Builder<static>|ServiceCategory whereSeoTitle($value)
 * @method static Builder<static>|ServiceCategory whereSlug($value)
 * @method static Builder<static>|ServiceCategory whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ServiceCategory extends Model
{
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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function service(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
