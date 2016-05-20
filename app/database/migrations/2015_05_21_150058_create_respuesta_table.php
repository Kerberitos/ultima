<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('respuestas', function(Blueprint $table)
		{
			$table->increments('id');

			$table->unsignedInteger('comentario_id');
			$table->foreign('comentario_id')->references('id')->on('comentarios');


			$table->unsignedInteger('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('usuarios');

			$table->text('respuesta');

			$table->string('estatus');
			$table->string('estatus_revision');
			$table->integer('admin');
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('respuestas');
	
	}

}
