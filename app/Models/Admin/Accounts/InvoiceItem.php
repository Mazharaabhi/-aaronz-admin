<?php

namespace App\Models\Admin\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'sku',
        'description',
        'unit_cost',
        'quantity',
        'net_total',
        'discount_rate',
        'discount_amount',
        'tax_rate',
        'tax_total',
        'total'
    ];

}
