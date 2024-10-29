<?php

namespace App\Orchid\Screens;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class TaskScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        // untuk mendapatkan semua data 
        return [
            'tasks' => Task::latest()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Simple To-Do List';
    }

    /**
     * Displays a description on the user's screen
     * directly under the heading.
     */
    public function description(): ?string
    {
        return 'Orchid Quickstart';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        // menampilkan halaman input
        return [
            ModalToggle::make('Add Task')
            ->modal('taskModal')
            ->method('create')
            ->icon('plus'),
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
            // membuat layaknya table untuk menampilkan action inget isi query dahulu agar dapat data
            Layout::table('tasks', [
                // menambahkan table data 'name'
                TD::make('name'),
                TD::make('price', 'Price (Rp)')->render(function ($model){
                    return number_format($model->price, 0, ',', '.');
                }),
                // membuat tombol action untuk menghapus data
                TD::make('Actions')
                ->alignRight()
                ->render(function (Task $task) {
                // membuat tombol peringatann jika mau menghapus
                    return Button::make('Delete Task')
                        ->confirm('After deleting, the task will be gone forever.')
                        ->method('delete', ['task' => $task->id]);
                }),
            ]),    
            
            // membuat kolom input
            Layout::modal('taskModal', Layout::rows([
                Input::make('task.name')
                    ->title('Name')
                    ->placeholder('Enter task name')
                    ->help('The name of the task to be created.')
                    ->popover('Tooltip - hint that user opens himself.')
                    ->required(),
                
                Input::make('task.price')
                    ->title('Price')
                    ->placeholder('Enter Price')
                    ->help('The name of the task to be created.')
                    ->popover('Eaaaaa')
                    ->required()
                    ->type('number'),
            ]))
                // menamai tombol saat di kolom input
                ->title('Create Task')
                ->applyButton('Add Task'),
        ];
    }

    // membuat logika tambah data
    public function create(TaskRequest $request)
    {
    // Validate form data, save task to database, etc.

        $task = new Task();
        $task->name = $request->input('task.name');
        $task->price = $request->input('task.price');
        $task->save();
    }

    // membuat logika hapus data
    public function delete(Task $task)
    {
        $task->delete();
    }
    
}
