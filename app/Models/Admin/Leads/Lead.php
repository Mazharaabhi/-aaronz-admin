<?php

namespace App\Models\Admin\Leads;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Leads\LeadLog;
use App\Models\Properties\Property;
use App\Models\TenancyCheque;
use App\Models\TenancyContract;

class Lead extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function requester()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assigned_to()
    {
        return $this->hasOne(AssignedLead::class, 'lead_id');
    }


    public function tenancy()
    {
        return $this->hasOne(TenancyContract::class, 'lead_id');
    }

    public function logs()
    {
        return $this->hasMany(LeadLog::class, 'lead_id');
    }

    public function property()
    {
        return $this->hasOne(Property::class, 'id');
    }
    public function lead_property()
    {
        return $this->hasOne(Property::class, 'id','property_id');
    }

}
