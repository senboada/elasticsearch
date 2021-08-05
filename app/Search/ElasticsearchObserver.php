<?php

namespace App\Search;

use App\Article;
use Elasticsearch\Client;
use Illuminate\Support\Facades\Log;

class ElasticsearchObserver
{
    /** @var \Elasticsearch\Client */
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function saved($model)
    {
        Log::debug("Entro a guardar un nuevo dato");
        Log::debug($model->getSearchIndex());
        Log::debug($model->getSearchType());
        Log::debug($model->getKey());
        Log::debug($model->toSearchArray());
        $this->elasticsearch->index([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
            'body' => $model->toSearchArray(),
        ]);
    }

    public function deleted($model)
    {
        $this->elasticsearch->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
        ]);
    }
}