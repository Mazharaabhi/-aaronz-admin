<?php

namespace App\Models\Admin\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paytab extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'server_key',
        'profile_id',
        'currency',
        'cart_id',
        'type',
        'active',
        'create_by',
        'modify_by'
    ];
}
