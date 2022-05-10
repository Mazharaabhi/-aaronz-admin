<?php

namespace App\Models\Properties;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Properties\Property;

class FavProperty extends Model
{
    use HasFactory;

    public function properties()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
