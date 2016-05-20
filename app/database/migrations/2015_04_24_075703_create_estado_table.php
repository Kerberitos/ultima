<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoTable extends Migration {

	public function up()
	{
		Schema::create('estados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('estado',20);
		});
	}

	
	public function down()
	{
		Schema::drop('estados');
	}

}
