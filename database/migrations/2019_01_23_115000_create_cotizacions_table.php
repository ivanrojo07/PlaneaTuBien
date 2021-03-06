<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prospecto_id')->unsigned();
            $table->foreign('prospecto_id')->references('id')->on('prospectos');
            $table->integer('promocion_id')->unsigned()->nullable();
            $table->foreign('promocion_id')->references('id')->on('promocions');
            $table->string('folio');
            $table->string('monto');
            $table->boolean('elegir')->default(0);
            $table->unsignedInteger('ahorro')->default(0);
            $table->unsignedInteger('plan_id')->references('id')->on('plans');
            $table->foreign('plan_id')->references('id')->on('plans');
            // se agrego despues
            $table->decimal('descuento',5,2)->default(0.00);    
            $table->decimal('inscripcion',8,2)->default(0.00);
            $table->decimal('factor_actualizacion')->default(3);
            $table->string('tipo_inscripcion');
            $table->boolean('liberar')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizacions');
    }
}
