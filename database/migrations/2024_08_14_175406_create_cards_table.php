<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('imageSrc')->nullable(); // Permite valores nulos
            $table->string('pdfLink')->nullable(); // También puedes hacer esto para pdfLink si es opcional
            $table->timestamps();
        });
    }

    /**
     * Reversa las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
