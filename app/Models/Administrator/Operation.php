<?php

namespace App\Models\Administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    public function modules()
    {
        return $this->belongsTo('\App\Models\Administrator\Module', 'module_id');
    }

    public function privilegs()
    {
        return $this->hasMany('\App\Models\Administrator\Privileg', 'operation_id');
    }
}
