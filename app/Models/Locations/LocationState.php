<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Properties\Property;

class LocationState extends Model
{
    use HasFactory;

    public function location_countries()
    {
        return $this->belongsTo('\App\Models\Locations\LocationCountry', 'location_country_id');
    }

    public function location_areas()
    {
        return $this->hasMany('\App\Models\Locations\LocationArea', 'location_state_id');
    }


    public function properties()
    {
        return $this->hasMany(Property::class, 'location_state_id');
    }


}
