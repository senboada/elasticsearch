<?php

namespace App\Models;

use App\Search\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use Searchable;

    protected $casts = [
        'tags' => 'json',
    ];

    protected $fillable = ['title', 'body', 'tags'];
}
