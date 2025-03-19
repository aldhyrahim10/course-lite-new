<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $fillable = ['article_category_name'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
