<?php

namespace App\Models\Admin\Email;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner',
        'banner_height',
        'banner_width'
    ];
}
