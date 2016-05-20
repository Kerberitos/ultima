<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mensajes', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->unsignedInteger('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('usuarios');
			
			$table->integer('remitente_id');
			$table->char('remitente_rol',2);

			$table->integer('anuncio_id');

			$table->string('remitente_nombre');
			$table->string('mensaje');
			$table->string('mensaje_previo');
			$table->string('previodate');

			$table->string('estatus_visto');
			
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
		Schema::drop('mensajes');
	}

}
