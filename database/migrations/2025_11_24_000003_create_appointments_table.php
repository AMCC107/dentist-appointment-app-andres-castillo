<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->nullable();
            $table->dateTime('fecha_hora')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('paciente_id')->nullable();
            $table->unsignedBigInteger('tratamiento_id')->nullable();
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('paciente_id')->references('id')->on('patients')->onDelete('set null');
            $table->foreign('tratamiento_id')->references('id')->on('treatments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['paciente_id']);
            $table->dropForeign(['tratamiento_id']);
        });
        Schema::dropIfExists('appointments');
    }
};
