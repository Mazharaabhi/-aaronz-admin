<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    public function ServiceCategories()
    {
        return $this->belongsTo('\App\Models\Services\ServiceCategory', 'service_category_id', 'id');
    }
    public function Categories()
    {
        return $this->hasMany('\App\Models\Services\ServiceCategory', 'id', 'service_category_id');
    }

    public function sub_services()
    {
        return $this->hasMany('\App\Models\Services\ServiceCategory', 'service_category_id', 'id')->where(['level' => 2, 'lang_id' => 1, 'status' => 1]);
    }

    public function list_services()
    {
        return $this->hasMany(ListService::class, 'service_sub_category_id')->where(['lang_id' => 1, 'live_status' => 1, 'status' => 1]);
    }
    public function service_questions()
    {
        return $this->hasMany(ServiceQuestion::class, 'service_sub_category_id')->where(['lang_id' => 1, 'status' => 1]);;
    }
}
