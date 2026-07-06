<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;


new class extends Component
{
    public $todos = []; // So definiert man die Eigenschaft für die Schleife die sich in create.blade.php befindet
    public $addContent = '';
    public $editContent = '';
    public $deleteTodo = '';

    public function mount()
    {
        $this->addContent = Auth::user()->addContent;
        $this->editContent = Auth::user()->editContent;
        $this->deleteTodo = Auth::user()->deleteTodo;
    }

    public function createTodo()
    {
        auth()->user()->todos()->create(['content' => $this->addContent]);
        $this->todos = auth()->user()->todos;
        $this->addContent = '';
    }


    public function editTodo()
    {
        auth()->user()->todos()->edit(['content' => $this->editContent]);
        $this->editContent = '';
    }

    public function deleteTodo()
    {

    }
};