<?php

namespace App\Orchid\Screens;

use App\Models\Book;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class BookEditScreen extends Screen
{
    public $book;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Book $book): iterable
    {
        return [
            'book' => $book,
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
            Button::make('Create Book')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->book->exists),
            
            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->book->exists),
                
            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->book->exists),
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
            Layout::rows([
                Input::make('book.name')
                    ->title('Judul')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

                Input::make('book.author')
                    ->title('Penulis')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

                TextArea::make('book.description')
                    ->title('Deskripsi')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Input::make('book.year')
                    ->title('Tahun Buku')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.')
                    ->type('number'),
            ])
        ];
    }

    public function createOrUpdate(Request $request) {
        $this->book->fill($request->get('book'))->save();

        Alert::info('You have successfully created a post.');

        return redirect()->route('platform.book.list');
    }

    public function remove()
    {
        $this->book->delete();

        Alert::info('You have successfully deleted the post.');

        return redirect()->route('platform.post.list');
    }
}
