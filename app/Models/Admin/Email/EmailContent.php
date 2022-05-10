<?php

namespace App\Models\Admin\Email;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'email_category_id',
        'content',
        'create_by',
        'modify_by'
    ];
}
