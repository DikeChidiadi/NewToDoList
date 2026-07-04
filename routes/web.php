<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('todo/create', 'todo.create')->name('todo.create');
});

require __DIR__.'/settings.php';
