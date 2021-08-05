<?php

namespace App\Articles;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use App\Articles\ArticlesRepository;

class EloquentRepository implements ArticlesRepository
{
    public function search(string $query = ''): Collection
    {
        return Article::query()
            ->where('body', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();
    }
}