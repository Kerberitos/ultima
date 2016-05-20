<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cuentas', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->unsignedInteger('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('usuarios');
			
			$table->unsignedInteger('estado_id');
			$table->foreign('estado_id')->references('id')->on('estados');
			

			$table->string('social_id')->nullable();
			$table->boolean('bandera_social');

			$table->string('correo');
			$table->string('password',750);


			//random usado para activar la cuenta de usuario despuésde registro
			//llave unica
			$table->string('random',50)->nullable();
			
			$table->rememberToken();

			$table->boolean('nav_avanzada');
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
		Schema::drop('cuentas');
	}

}
