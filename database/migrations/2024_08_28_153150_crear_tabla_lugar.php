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
        Schema::create('lugars', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('cantPersonas');
            $table->integer('cantCamas');
            $table->integer('cantBanios');
            $table->integer('cantHabitaciones');
            $table->integer('tieneWifi');
            $table->integer('cantVehiculosParqueo');
            $table->decimal('precioNoche', 6, 2);
            $table->decimal('costoLimpieza', 6, 2);
            $table->string('ciudad');
            $table->string('latitud');
            $table->string('longitud');
            $table->foreignId('arrendatario_id')->constrained('arrendatarios');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lugars');
    }
};
