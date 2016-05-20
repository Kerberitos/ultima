<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolTable extends Migration {
	
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
    		$table->increments('id');
    		$table->string('rol',20);
    		
		});
	}

	public function down()
	{
		Schema::drop('roles');
	}


}