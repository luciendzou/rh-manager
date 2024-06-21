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
        Schema::create('attendences', function (Blueprint $table) {
            $table->id('id_attendences');
            $table->unsignedBigInteger('id_utilisateurs');
            $table->date('date_check')->format('d-m-Y');
            $table->time('time_check');
            $table->string('mois');
            $table->string('annee');
            $table->string('event_check');
            $table->timestamps();

            $table->foreign('id_utilisateurs')->references('id_utilisateurs')->on('utilisateurs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendences');
    }
};
