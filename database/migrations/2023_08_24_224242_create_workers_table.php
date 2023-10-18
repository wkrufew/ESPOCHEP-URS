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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_encuesta');
            $table->integer('dia');
            $table->integer('efectivas')->default(0);
            $table->integer('nadie_en_casa')->default(0);
            $table->integer('rechazo')->default(0);
            $table->integer('informante_no_calificado')->default(0);
            $table->integer('temporal')->default(0);
            $table->integer('construccion')->default(0);
            $table->integer('destruida')->default(0);
            $table->integer('desocupada')->default(0);
            $table->text('observacion');
 
            $table->unsignedBigInteger('planning_id');
            $table->foreign('planning_id')->references('id')->on('plannings')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('certificado_id')->nullable();
            $table->foreign('certificado_id')->references('id')->on('certificados')->onDelete('cascade');

            $table->unsignedBigInteger('sticker_id')->nullable();
            $table->foreign('sticker_id')->references('id')->on('stickers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
