<?php

namespace App\Models\Admin\Paylinks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    use HasFactory;


    //TODO: Belongs to relatoin
    public function companies()
    {
        return $this->belongsTo('App\Models\User', 'company_id', 'id');
    } 
}
