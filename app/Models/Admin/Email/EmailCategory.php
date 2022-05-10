<?php

namespace App\Models\Admin\Email;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'email_subject',
        'is_active',
        'tags',
        'create_by',
        'modify_by',
    ];

}
