<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Book extends Model
{
    use AsSource, Attachable, Filterable, HasFactory;

    protected $fillable = [
        'name', 'author', 'description', 'year'
    ];
}
