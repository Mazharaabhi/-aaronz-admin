<?php

namespace App\Models\Admin\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Properties\PropertyType;
class Price extends Model
{
    use HasFactory;

    public function types()
    {
        return $this->belongsTo(PropertyType::class, 'type_id');
    }
}
