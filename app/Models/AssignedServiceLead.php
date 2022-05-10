<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedServiceLead extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function service_lead()
    {
        return $this->belongsTo(ServiceLead::class, 'lead_id');
    }
}
