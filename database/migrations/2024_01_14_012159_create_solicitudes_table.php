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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('cliente_solicitante'); // Cliente que solicita
            $table->decimal('valor_credito', 10, 2); // Valor de crédito que solicita
            $table->integer('cuotas_solicitadas'); // Cuotas que solicita
            $table->text('descripcion'); // Descripción
            $table->string('estado_solicitud'); // Estado de la solicitud
            $table->date('fecha_solicitud'); // Fecha de solicitud
            $table->string('tipo_credito'); // Tipo de crédito
            $table->text('observaciones_asesor')->nullable(); // Observaciones del asesor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
