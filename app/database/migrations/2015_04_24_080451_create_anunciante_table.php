<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnuncianteTable extends Migration {

		/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anunciantes', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->unsignedInteger('anuncio_id');
			$table->foreign('anuncio_id')->references('id')->on('anuncios');
			$table->string('anunciante');
			//$table->string('correo');
			$table->string('celular');
			$table->string('telefono');
			$table->integer('compania_id');
			$table->boolean('whatsapp');	
			$table->string('tipopersona');
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
		Schema::drop('anunciantes');
		
	}

}
