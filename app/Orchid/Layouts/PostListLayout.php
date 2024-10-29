<?php

namespace App\Orchid\Layouts;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PostListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'posts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title')
                ->render(function (Post $post) {
                    return Link::make($post->title)
                        ->route('platform.post.edit', $post);
                }),

            TD::make('created_at', 'Created')
                ->render(function($post) {
                    return Carbon::parse($post->created_at)->format('D, d M Y');
                }),
            TD::make('updated_at', 'Last edit')
                ->render(function($post) {
                    return Carbon::parse($post->updated_at)->format('D, d M Y');
                }),
        ];
    }
}
