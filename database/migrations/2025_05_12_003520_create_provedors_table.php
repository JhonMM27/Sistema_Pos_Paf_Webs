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
        Schema::create('provedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            // $table->enum('persona', ['natular', 'juridica']);
            $table->string('ruc_dni')->unique();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('correo')->nullable();
            $table->text('observaciones')->nullable();

            $table->unsignedSmallInteger('TipoProveedor_id');

            // $table->foreign('TipoProveedor_id')->references('id')->on('tipo_proveedor')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provedors');
    }
};
