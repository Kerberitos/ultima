<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniaTable extends Migration {

	public function up()
	{
		Schema::create('companias', function(Blueprint $table)
		{
    		$table->increments('id');
    		$table->string('nombre',15);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companias');
	}


}
