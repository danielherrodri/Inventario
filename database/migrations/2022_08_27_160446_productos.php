<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('categoria', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sucursal', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->float('precio');
            $table->date('fecha_compra');
            $table->text('comentarios')->nullable();
            $table->foreignId('estado_id')->references('id')->on('estado')->default(1);
            $table->foreignId('categoria_id')->references('id')->on('categoria');
            $table->foreignId('sucursal_id')->references('id')->on('sucursal');
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
        Schema::dropIfExists('producto');
        Schema::dropIfExists('sucursal');
        Schema::dropIfExists('categoria');
        Schema::dropIfExists('estado');
    }
}
