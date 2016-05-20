<?php

require (__DIR__.'/routes/basicas.php');

Route::group(['before'=>'guest'], function(){

	require (__DIR__.'/routes/guest.php');

});


Route::group(['before'=>'auth'], function(){
	require (__DIR__.'/routes/auth.php');

	//*** rutas de administrador ***

	Route::group(['before'=>'is_admin'], function()
	{
		require (__DIR__.'/routes/admin.php');

		//******** rutas de super usuario******
		Route::group(['before'=>'is_super'], function(){

			require (__DIR__.'/routes/super.php');

		});	
	});
});


/*Ruta para presentar error 404 page no found*/
App::missing(function($exception){
	return Response::view('errores.error404', array(), 404);
});




