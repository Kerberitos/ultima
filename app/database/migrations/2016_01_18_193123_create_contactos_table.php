<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incidentes', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('receptor_rol');

			$table->string('nombres');
			$table->string('correo');
			$table->string('motivo');
			$table->string('mensaje');

			$table->string('estatus_visto');
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
		Schema::drop('incidentes');
	}

}
