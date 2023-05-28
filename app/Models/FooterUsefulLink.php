<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterUsefulLink extends Model
{
    protected $fillable = [
        'name', 'url', 'status', 'position'
    ];
}
