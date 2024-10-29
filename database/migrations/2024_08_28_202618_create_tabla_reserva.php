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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lugar_id')->constrained('lugares');
            $table->foreignId('cliente_id')->constrained('users');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->decimal('precioTotal', 6, 2);
            $table->decimal('precioLimpieza', 6, 2);
            $table->decimal('precioNoches', 6, 2);
            $table->decimal('precioServicio', 6, 2);
            $table->decimal('costoLimpieza', 6, 2);
            $table->string('ciudad');
            $table->string('latitud');
            $table->string('longitud');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
