<?php


use Livewire\Component;

new class extends Component
{
    public $todos = []; // So definiert man die Eigenschaft für die Schleife die sich in create.blade.php befindet
    public string $addContent = '';
    public string $editContent = '';
    public $deleteTodo = '';


    public function addContent()
    {
        auth()->user()->todos()->create(['content' => $this->addContent]);
        $this->addContent = '';
    }

    public function editContent()
    {
        $this->editContent = '';
        return 'Todo successfully updated.';
    }

    public function deleteTodo()
    {
        return 'Todo successfully deleted.';
    }
};