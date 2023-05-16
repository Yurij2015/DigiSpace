<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderNavBarContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_col_name',
        'first_col_href',
        'first_col_href_content',
        'second_col_name',
        'second_col_href',
        'second_col_href_content',
        'first_soc_button_style',
        'first_soc_button_href',
        'second_soc_button_style',
        'second_soc_button_href',
        'third_soc_button_style',
        'third_soc_button_href',
        'fourth_soc_button_style',
        'fourth_soc_button_href',
        'login_button_status'
    ];
}
