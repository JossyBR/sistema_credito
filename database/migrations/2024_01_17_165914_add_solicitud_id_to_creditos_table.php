<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('creditos', function (Blueprint $table) {
            $table->unsignedBigInteger('solicitud_id'); // Añade la columna solicitud_id
            $table->foreign('solicitud_id')->references('id')->on('solicitudes'); // Establece la clave foránea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('creditos', function (Blueprint $table) {
            $table->dropForeign(['solicitud_id']); // Elimina la clave foránea
            $table->dropColumn('solicitud_id'); // Elimina la columna
        });
    }
};
