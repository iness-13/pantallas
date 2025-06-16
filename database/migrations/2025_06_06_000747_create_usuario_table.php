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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario'); // ID autoincremental
            $table->string('nom_usuario', 30);
            $table->string('ap_usuario', 30);
            $table->string('am_usuario', 30);
            $table->string('tel_cel_usuario', 10);
            $table->string('tel_emergencia', 10);
            $table->string('rfc', 13);
            $table->string('notas_medicas', 255)->nullable(); // Se permite nulo si no hay notas
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
