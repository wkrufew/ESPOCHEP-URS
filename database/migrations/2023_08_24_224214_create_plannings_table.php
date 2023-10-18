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
        Schema::create('plannings', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('provincia');
            $table->string('canton');
            $table->string('parroquia');
            $table->string('dpa');
            $table->string('areacensal');
            $table->string('codigo_manzana');
            $table->integer('tipo_sector');
            $table->string('hogares_planificados');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('dias')->nullable();
            $table->enum('status',[0,1,2])->default(1);

            $table->unsignedBigInteger('phase_id');
            $table->foreign('phase_id')->references('id')->on('phases')->onDelete('cascade');

            $table->unsignedBigInteger('equipment_id');
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');

            $table->timestamps();
           
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plannings');
    }
};
