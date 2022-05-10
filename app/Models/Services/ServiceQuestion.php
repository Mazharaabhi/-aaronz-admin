<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceQuestion extends Model
{
    use HasFactory;
    public function ServiceCategory()
    {
        return $this->belongsTo('\App\Models\Services\ServiceCategory', 'service_category_id', 'id');
    }
    public function ServiceSubCategory()
    {
        return $this->belongsTo('\App\Models\Services\ServiceCategory', 'service_sub_category_id', 'id');
    }
    public function QuestionOptions()
    {
        return $this->hasMany('\App\Models\Services\ServiceQuestionOption', 'question_id', 'id')->where('lang_id', 1);
    }

}
