<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaTable extends Migration {
/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categorias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('categoria');
			
			
			$table->unsignedInteger('seccion_id');
			$table->foreign('seccion_id')->references('id')->on('secciones');
			
			$table->string('icono');
			
			
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categorias');
	}
}
