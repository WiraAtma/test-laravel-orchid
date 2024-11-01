<?php

namespace App\Orchid\Screens;

use App\Models\Book;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class BookListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'book' => Book::filters()->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'List Buku';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            DropDown::make('Actions')
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            Link::make('Create')->href('book'),
                        ]),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('book', [
                TD::make('name', 'Nama')
                    ->render(function (Book $book) {
                        return Link::make($book->name)
                            ->route('platform.book.edit', $book);
                    }),
                TD::make('author', 'Pengarang'),
                TD::make('description', 'Deskripsi'),
                TD::make('year', 'Tahun Terbit'),
            ])
        ];
    }
}
