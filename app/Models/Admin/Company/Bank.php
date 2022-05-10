<?php

namespace App\Models\Admin\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'bank_name',
        'bic',
        'account_name',
        'iban',
        'account_no',
        'currency',
        'status',
        'is_active',
    ];
}
