<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_name',
        'url',
        'type',
    ];
    public function imageable()
    {
        return $this->morphTo();
    }

}
