<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpcionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preguntas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('opcion');
			$table->unsignedInteger('seccion_id');
			$table->foreign('seccion_id')->references('id')->on('secciones');
			
			
			
			
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('preguntas');
	}


}
