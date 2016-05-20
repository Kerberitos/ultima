<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comentarios', function(Blueprint $table)
		{
			$table->increments('id');

			$table->unsignedInteger('anuncio_id');
			$table->foreign('anuncio_id')->references('id')->on('anuncios');

			$table->unsignedInteger('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('usuarios');

			$table->text('comentario');

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
			Schema::drop('comentarios');
	}

}
