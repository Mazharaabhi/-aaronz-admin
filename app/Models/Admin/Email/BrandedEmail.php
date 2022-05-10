<?php

namespace App\Models\Admin\Email;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandedEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'email'
    ];
}
