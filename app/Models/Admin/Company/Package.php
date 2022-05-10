<?php

namespace App\Models\Admin\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sales_limit',
        'tax',
        'charge',
        'american_tax',
        'withdraw_charges',
        'type',
        'create_by',
        'modify_by'
    ];
}
