<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('task/create', 'task.create')->name('task.create');
});

require __DIR__.'/settings.php';
