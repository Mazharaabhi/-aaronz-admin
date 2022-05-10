<?php

namespace App\Models\Admin\Leads;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedLead extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
}
