<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;


new class extends Component
{
    public $todos = []; // So definiert man die Eigenschaft für die Schleife die sich in create.blade.php befindet
    public $addContent = '';
    public $editContent = '';
    // public $deleteTodo = ''; da werd ich noch was im ReadMe.md dazuschreiben

    public function mount()
    {
        $this->todos = auth()->user()->todos;
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

    public function deleteTodo(int $id)
    {
        auth()->user()->todos()->where('id', $id)->delete();
        $this->todos = auth()->user()->todos;
    }
};