<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $product_id
 * @property int $service_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $service_css_class
 * @property string|null $product_css_class
 *
 * @method static Builder<static>|ProductService newModelQuery()
 * @method static Builder<static>|ProductService newQuery()
 * @method static Builder<static>|ProductService query()
 * @method static Builder<static>|ProductService whereCreatedAt($value)
 * @method static Builder<static>|ProductService whereId($value)
 * @method static Builder<static>|ProductService whereProductCssClass($value)
 * @method static Builder<static>|ProductService whereProductId($value)
 * @method static Builder<static>|ProductService whereServiceCssClass($value)
 * @method static Builder<static>|ProductService whereServiceId($value)
 * @method static Builder<static>|ProductService whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class ProductService extends Model
{
    public $table = 'product_service';

    protected $fillable = [
        'service_css_class',
        'product_css_class'
    ];
}
