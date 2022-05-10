<?php

namespace App\Models\Admin\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    //TODO: Creating Title Name Mutator here
    public function SetTitleNameAttribute($name)
    {
        return $this->attributes['name'] = ucfirst(strtolower($name));
    }


    //TODO: Creating slug Mutator here
    public function SetSlugAttribute($slug)
    {
        return $this->attributes['slug'] = strtolower($slug);
    }

    public function menus()
    {
        return $this->belongsTo('\App\Models\Cms\Navbar', 'menu_id', 'id');
    }

    public function types()
    {
        return $this->belongsTo('\App\Models\Admin\Services\Service', 'service_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo('\App\Models\Admin\Services\Service', 'service_id', 'id');
    }

    public function sub_categories()
    {
        return $this->belongsTo('\App\Models\Admin\Services\Service', 'service_id', 'id');
    }
}
