<?php

namespace App\Models\Properties;

use App\Models\Cms\Page;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;

    public function types()
    {
        return $this->belongsTo(PropertyType::class, 'type_id');
    }
    public function page()
    {
        return $this->belongsTo(Page::class, 'property_type_id');
    }
}
