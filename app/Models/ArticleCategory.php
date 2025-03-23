<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['article_category_name'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
