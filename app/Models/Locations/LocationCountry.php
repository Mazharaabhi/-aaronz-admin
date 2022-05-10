<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Locations\LocationState;
class LocationCountry extends Model
{
    use HasFactory;

    public function location_states()
    {
        return $this->hasMany(LocationState::class, 'location_country_id');
    }
}
