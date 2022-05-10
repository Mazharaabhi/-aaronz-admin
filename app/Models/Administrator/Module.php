<?php

namespace App\Models\Administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    public function operations()
    {
        return $this->hasMany('App\Models\Administrator\Operation', 'module_id');
    }
}
