<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceLead extends Model
{
    use HasFactory;
    protected $guarded = [];
    //SERVICE PROVIDER COMPANY//
    public function requester()
    {
        return $this->belongsTo(User::class, 'company_id');
    }
    //END SERVICE PROVIDER COMPANY//
    public function service_assigned_to()
    {
        return $this->hasOne(AssignedServiceLead::class, 'lead_id');
    }

    public function service_logs()
    {
        return $this->hasMany(ServiceLeadLog::class, 'lead_id');
    }

    public function services()
    {
        return $this->hasOne(Service::class, 'id');
    }
    public function lead_service()
    {
        return $this->hasOne(Service::class, 'id','service_id');
    }
    public function service_lead_deatils()
    {
        return $this->hasMany(ServiceLeadDetail::class,'service_lead_id','id');
    }
}
