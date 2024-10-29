<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use AsSource, Attachable, Filterable;

    protected $fillable = [
        'title',
        'description',
        'body',
        'author'
    ];

    protected $allowedSorts = [
        'title',
        'created_at',
        'updated_at',
    ];

}
