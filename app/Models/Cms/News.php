<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cms\NewsCategory;
use App\Models\User;
class News extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id')->where('lang_id', 1);
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

}
