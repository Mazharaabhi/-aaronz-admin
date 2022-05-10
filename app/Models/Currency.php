<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
        'from_currency',
        'to_currency',
        'rate',
        'active',
        'create_by',
        'modify_by'
    ];
}
