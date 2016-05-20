<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration {
public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->increments('id');
			
			//referencias externas para las otras tablas
			
			//Referencias para la tabla roles
		
			
			//Referencias para la tabla colroeselulares
			//$table->unsignedInteger('compania_id');
			//$table->foreign('compania_id')->references('id')->on('companias');
			
			$table->unsignedInteger('rol_id');
			$table->foreign('rol_id')->references('id')->on('roles');

			$table->integer('compania_id');
			//Atributos de la tabla usuarios
			
			
			$table->string('nombres',30);
			$table->char('genero', 4);
			
			
			$table->string('foto');
			
			$table->longText('telefono')->nullable();
			$table->longText('celular')->nullable();
			$table->string('slug');
			
			//atributo pra determinar si el usuario a cambiado su nombre
			//puede cambiar su nombre una sola vez
			$table->boolean('cambio');
			//para añadir las columnas created_at y updated_at
			$table->timestamps();
			
			

			
		});
	}


	public function down()
	{
		Schema::drop('usuarios');
		
	}


}
