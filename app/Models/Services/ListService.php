<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class ListService extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function services()
    {
        return $this->hasMany(ListService::class, 'service_sub_category_id');
    }

    public function sub_service()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_sub_category_id')->where('lang_id', 1);
    }

    public function service()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id')->where('lang_id', 1);
    }

}
