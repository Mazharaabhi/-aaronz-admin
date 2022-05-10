<?php

namespace App\Models\Cms;

use App\Models\Properties\PropertyType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    public function types()
    {
        return $this->belongsTo(Navbar::class, 'menu_id')->where('lang_id', 1);
    }
}
