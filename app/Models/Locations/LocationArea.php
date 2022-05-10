<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Properties\Property;

class LocationArea extends Model
{
    use HasFactory;

    public function location_countries()
    {
        return $this->belongsTo('\App\Models\Locations\LocationCountry', 'location_country_id');
    }

    public function location_states()
    {
        return $this->belongsTo('\App\Models\Locations\LocationState', 'location_state_id')->where('lang_id' , 1);
    }

    public function old_locations()
    {
        return $this->belongsTo('\App\Models\Locations\Location', 'location_id');
    }

    public function locations()
    {
        return $this->hasMany('App\Models\Locations\Location', 'location_area_id');
    }


    public function properties()
    {
        return $this->hasMany(Property::class, 'location_area_id')->where('lang_id', 1);
    }

    public function getSlugAttribute($value)
    {
        return '/'.($value);
    }
}
