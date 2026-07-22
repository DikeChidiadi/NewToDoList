<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;


new class extends Component
{
    public $todos = []; // So definiert man die Eigenschaft für die Schleife die sich in create.blade.php befindet
    public $addContent = ''; // So definiert man die Eigenschaft die ich in create.blade.php benutzen werde.
    public $editId = ''; // So definiert man die Eigenschaft die ich in edit.blade.php benutzen werde.
    public $editContent = ''; // So definiert man die Eigenschaft die ich in edit.blade.php benutzen werde.

    public function mount() // Mit dieser Funktion wird die Komponente geladen, um die Daten zu laden.
    {
        $this->todos = auth()->user()->todos;
    }

    public function createTodo()
    {
        auth()->user()->todos()->create(['content' => $this->addContent]);
        $this->todos = auth()->user()->todos;
        $this->addContent = '';
    }


    public function editTodo(int $id)
    {
        $todo = auth()->user()->todos()->find($id);
        $this->editId = $id;
        $this->editContent = $todo->content;
    }

    public function updateTodo()
    {
        auth()->user()->todos()->where('id', $this->editId)->update(['content' => $this->editContent]);
        $this->todos = auth()->user()->todos;
        $this->editContent = '';
    }

    public function deleteTodo(int $id)
    {
        auth()->user()->todos()->where('id', $id)->delete();
        $this->todos = auth()->user()->todos;
    }

    public function toggleTodo(int $id) 
    {
        $todo = auth()->user()->todos()->findOrFail($id);
        $todo->update(['completed' => !$todo->completed]);
        $this->todos = auth()->user()->todos;
    }
};