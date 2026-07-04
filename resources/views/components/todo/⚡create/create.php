<?php


use Livewire\Component;

new class extends Component
{
    public $todos = []; // So definiert man die Eigenschaft für die Schleife die sich in create.blade.php befindet
    public $addContent = '';
    public $editContent = '';
    public $deleteTodo = '';


    public function createTodo()
    {
        auth()->user()->todos()->create(['content' => $this->addContent]);
        $this->addContent = '';
        return redirect('todo/create')->with('success', 'Todo successfully created.');
    }

    public function updateTodo()
    {
        return 'Todo successfully updated.';
    }

    public function deleteTodo()
    {
        return 'Todo successfully deleted.';
    }
};