<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    use HasFactory;
    //TODO: Fillable
    protected $fillable = ['name', 'lang_id', 'parent_id', 'slug', 'sort', 'status'];

    //TODO: Creating Mutator for Title English
    public function setTitleNamehAttribute($name)
    {
        return $this->attributes['name'] = strtoupper($name);
    }

    //TODO: Creating Mutator for Slug
    public function setSlugAttribute($slug)
    {
        return $this->attributes['slug'] = strtolower($slug);
    }

    public function services()
    {
        return $this->hasMany('\App\Models\Admin\Services\Service', 'menu_id', 'id');
    }

}
