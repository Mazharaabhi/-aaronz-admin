<?php

namespace App\Models\Admin\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'amount',
        'admin_charges',
        'reason',
        'status',
        'modify'
    ];

    //Belongs To Reason Ship
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'company_id');
    }
}
