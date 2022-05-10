<?php

namespace App\Models\Admin\Paylinks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'tran_ref',
        'cart_amount',
        'cart_id',
        'payment_date',
        'payment_method',
        'currency',
        'tran_type',
        'tran_time',
        'token',
        'type',
        'description',
        'tran_id',
        'account_type',
        'resource',
        'status',
        'invoice_id',
        'redirect_url',
        'invoice_ref',
        'customer_ref',
        'tran_count',
        'resp_msg',
        'resp_code',
        'parent_id',
        'refund_resp',
        'conversion_rate',
        'conversion_amount',
        'transferable_amount',
        'create_by',
        'modify_by'
    ];

    //TODO: Reverse Relation Ship
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    // //TODO: Reverse Relation Ship
    public function companies()
    {
        return $this->belongsTo('App\Models\User', 'company_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Admin\Paylinks\Transaction', 'parent_id');
    }

}
