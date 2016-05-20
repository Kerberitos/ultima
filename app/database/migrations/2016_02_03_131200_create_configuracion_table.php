<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracionTable extends Migration {

	
	public function up()
	{
		Schema::create('configuraciones', function(Blueprint $table)
		{
    		$table->increments('id');
    		

    		$table->integer('anunciosadministrador');
    		$table->integer('anunciosusuario');

    		$table->integer('anunciosbloqueados');
    		$table->integer('comentariosbloqueados');
    		
    		$table->integer('contadordedenuncias');
    		$table->char('solicitudes', 2);
    		
    		$table->timestamps();
    		
		});
	}

	public function down()
	{
		Schema::drop('configuraciones');
	}



}
