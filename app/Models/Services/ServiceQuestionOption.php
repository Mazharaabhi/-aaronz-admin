<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceQuestionOption extends Model
{
    use HasFactory;
    public function ServiceQuestion()
    {
        return $this->belongsTo('\App\Models\Services\ServiceQuestion', 'question_id', 'id');
    }
}
