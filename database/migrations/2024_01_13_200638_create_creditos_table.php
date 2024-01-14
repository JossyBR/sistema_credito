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
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_cuenta', 10)->unique(); // Número de cuenta: Único de 10 dígitos
            $table->decimal('valor_credito', 10, 2); // Valor del crédito: Numérico
            $table->integer('numero_cuotas'); // Número de cuotas: Numérico (6,12,24,36)
            $table->decimal('valor_cuota', 10, 2); // Valor de cuota: Calculado
            $table->string('cliente_solicitante'); // Cliente que solicitó
            $table->date('fecha_aprobacion'); // Fecha de aprobación
            $table->string('aprobador'); // Quien lo aprobó
            $table->string('tipo_credito'); // Tipo de crédito
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditos');
    }
};
