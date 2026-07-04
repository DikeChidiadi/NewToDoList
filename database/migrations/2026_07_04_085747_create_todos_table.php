<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->boolean('completed')->default(false); // Das bedeutet, dass das Feld standardmäßig false ist und die Aufgabe als noch nicht abgeschlossen betrachtet wird.
            $table->timestamps();

            $table->foreignId('user_id')->references(('id'))->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
