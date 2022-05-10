<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenancyContract extends Model
{
    use HasFactory;

    protected $table = 'tenancy_contracts';

    public function cheques()
    {
        return $this->hasMany(TenancyCheque::class, 'tenancy_contract_id');
    }

    public function tenant_images()
    {
        return $this->hasMany(TenancyImage::class, 'tenancy_contract_id','id')->where('type', 0);
    }

    public function owner_images()
    {
        return $this->hasMany(TenancyImage::class, 'tenancy_contract_id','id')->where('type', 1);
    }

}
