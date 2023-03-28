<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'details', 'price_value'
    ];
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
}
