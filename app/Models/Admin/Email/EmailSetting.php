<?php

namespace App\Models\Admin\Email;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_logo',
        'header_logo_width',
        'header_logo_height',
        'banner',
        'banner_width',
        'banner_height',
        'company_id',
        'company_name',
        'bg_color',
        'text_color',
        'footer_logo',
        'footer_logo_width',
        'footer_logo_height',
        'term_link',
        'policy_link',
        'fb',
        'linked_in',
        'instagram',
        'google_my_business',
        'youtube',
        'twitter',
        'email',
        'mobile',
        'address',
        'footer_color',
        'footer_text_color',
        'footer_link_color',
        'create_by',
        'modify_by'
    ];
}
