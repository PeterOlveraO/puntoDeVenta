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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre') ;
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('telefono', 25);
            $table->string('usuario');
            $table->string('contrasena');
            $table->boolean('administrador') -> default(false);
            $table->boolean('activo') -> default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
