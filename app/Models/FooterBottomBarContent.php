<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterBottomBarContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'privacy_policy_title',
        'privacy_policy_href',
        'faq',
        'faq_href',
        'support',
        'support_href'
    ];
}
