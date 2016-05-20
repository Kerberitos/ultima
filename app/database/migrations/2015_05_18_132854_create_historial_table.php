<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('historiales', function(Blueprint $table)
		{
			

			$table->increments('id');
			$table->unsignedInteger('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('usuarios');
			
			$table->integer('anunciosbloqueados');
			$table->integer('comentarioseliminados');

			$table->integer('denunciasverdaderas');
			$table->integer('denunciasfalsas');

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
		Schema::drop('historiales');
	}

}
