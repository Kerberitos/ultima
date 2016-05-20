<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialanuncioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('historialanuncios', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->unsignedInteger('anuncio_id');
			$table->foreign('anuncio_id')->references('id')->on('anuncios');
			
			
			$table->integer('politica_id');


			/*$table->unsignedInteger('admin_id');
			$table->foreign('admin_id')->references('id')->on('usuarios');*/

			$table->unsignedInteger('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('usuarios');
			
			
			# activar, bloquear, desbloquear anuncio

			$table->string('accion',12);
			$table->string('justificacion',110);
						
			$table->timestamps();
		
		});
	}


	public function down()
	{
		Schema::drop('historialanuncios');
		
	}


}