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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->enum('metodo_pago', ['efectivo', 'tarjeta', 'yape', 'plin']);
            $table->decimal('total', 10, 2);
            $table->enum('estado', ['emitida', 'anulada'])->default('emitida');
            
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('cliente_id')->nullable()->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
