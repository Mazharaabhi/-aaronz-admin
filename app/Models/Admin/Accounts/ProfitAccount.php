<?php

namespace App\Models\Admin\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfitAccount extends Model
{
    use HasFactory;


    //has belonsTo
    public function companies()
    {
        return $this->belongsTo('\App\Models\User', 'company_id');
    }
}
