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
        Schema::create('socializacions', function (Blueprint $table) {
            $table->id();
            $table->string('fase');
            $table->string('provincia');
            $table->string('canton');
            $table->string('parroquia');
            $table->string('codigo_manzana');
            $table->string('hogares_p');
            $table->string('hogares_i');
            $table->string('dipticos');
            $table->longText('observacion')->nullable();
            $table->string('status')->default('cerrado');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

            $table->index('codigo_manzana');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socializacions');
    }
};
