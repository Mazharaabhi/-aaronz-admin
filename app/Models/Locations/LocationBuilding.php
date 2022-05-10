<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Properties\Property;

class LocationBuilding extends Model
{
    use HasFactory;

    public function location_countries()
    {
        return $this->belongsTo('\App\Models\Locations\LocationCountry', 'location_country_id');
    }

    public function location_states()
    {
        return $this->belongsTo('\App\Models\Locations\LocationState', 'location_state_id');
    }

    public function location_areas()
    {
        return $this->belongsTo('\App\Models\Locations\LocationArea', 'location_area_id');
    }

    public function locations()
    {
        return $this->belongsTo('\App\Models\Locations\Location', 'location_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'location_id')->where('lang_id', 1);
    }
}
