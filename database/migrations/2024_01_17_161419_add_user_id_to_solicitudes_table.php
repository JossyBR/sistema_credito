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
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Añade la columna user_id
            $table->foreign('user_id')->references('id')->on('users'); // Establece la clave foránea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Elimina la clave foránea
            $table->dropColumn('user_id'); // Elimina la columna
        });
    }
};
