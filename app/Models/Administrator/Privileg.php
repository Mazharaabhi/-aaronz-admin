<?php

namespace App\Models\Administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privileg extends Model
{
    use HasFactory;


    protected $fillable = [
        'company_id',
        'role_id',
        'module_id',
        'operation_id',
        'is_view',
        'is_add',
        'is_edit',
        'is_status',
        'is_delete',
        'is_status'
    ];


    public function operations()
    {
        return $this->belongsTo('\App\Models\Administrator\Operation', 'operation_id');
    }

    public function modules()
    {
        return $this->belongsTo('\App\Models\Administrator\Module', 'module_id');
    }

}
