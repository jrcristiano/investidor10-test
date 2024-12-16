<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository extends Repository
{
    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

    public function findArticleBySlugOrFail(string $slug)
    {
        return $this->model->where('slug', $slug)
            ->firstOrFail();
    }
}
