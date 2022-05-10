<?php

namespace App\Models\Admin\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Accounts\InvoiceItem;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'invoice_no',
        'invoice_id',
        'sub_total',
        'shipping_charges',
        'extra_charges',
        'extra_discount',
        'total',
        'create_by'
    ];

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }
}
