<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notificaciones', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('notificacion');

			$table->unsignedInteger('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('usuarios');
			

			$table->string('estatus_visto');
			$table->string('tipo');
			
			$table->integer('identificativo');
			$table->timestamp('expiradate');
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
		Schema::drop('notificaciones');
	}

}
