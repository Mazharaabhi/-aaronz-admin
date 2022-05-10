<?php

namespace App\Models\Properties;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{
    use HasFactory;

    public function types()
    {
        return $this->belongsTo('\App\Models\Properties\PropertyType', 'property_type_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo('\App\Models\Properties\PropertyCategory', 'property_category_id', 'id');
    }

    public function sub_categories()
    {
        return $this->hasMany('\App\Models\Properties\PropertyCategory', 'property_category_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany('\App\Models\Properties\Property', 'property_category_id');
    }

}
