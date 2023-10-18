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
        Schema::create('insitus', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_insitu');
            $table->text('observacion')->nullable();
            //insutu
            $table->string('ubicacion')->nullable();
            $table->string('presentacion')->nullable();
            $table->string('objetivo')->nullable();
            $table->string('tipo_vivienda')->nullable();
            $table->string('diligencia_preguntas')->nullable();
            $table->string('miembros_hogar')->nullable();
            $table->string('numero_nucleos')->nullable();
            $table->string('registro_certificado')->nullable();
            $table->string('formulario_imagenes')->nullable();

            $table->unsignedBigInteger('planning_id');
            $table->foreign('planning_id')->references('id')->on('plannings')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('certificado_id')->nullable();
            $table->foreign('certificado_id')->references('id')->on('certificados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insitus');
    }
};
