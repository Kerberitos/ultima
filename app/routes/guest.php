<?php

/*
|
|	Rutas dónde se aplica el filtro guest
|   Solo usuarios que no han iniciado sesión -ingresar- pueden acceder a estas rutas.
|
|	NOTA IMPORTANTE:
|		- Filtros se encuentran en   miradita/app/filters
|		  
*/
	/*
	* MODULO DATOS ( miradita/app/controllers/datos )
	* Rutas cuando el usuario no ha iniciado sesión
	*/
	Route::group(array('namespace' => 'datos'), function()
	{
		/* Ruta para mostrar formulario de registro en la app */
		Route::get('registro', [
								  'as' => 'registro',
								  'uses' => 'RegistroController@getRegistro'
							   ]
		);
		
		/* Ruta para dar de alta (registrar) usuario */
		Route::post('registro', [
									'as' => 'registro', 
									'uses' => 'RegistroController@postRegistro'
								]
		);

		/* Ruta para mostrar formulario de ingreso en la app*/
		Route::get('ingreso', [
								'as' => 'ingreso',
								'uses' => 'AutenticacionController@getIngreso'
							  ]
		);
		
		/* Ruta para procesar ingreso (iniciar sesión) en la aplicación */
		Route::post('ingreso',  [
								   'as' => 'ingreso',
								   'uses' => 'AutenticacionController@postIngreso'
								]
		);


		/* Ruta para llamado a ingreso por facebook */
		Route::get('ingresofacebook', [
										'as' => 'ingresofacebook',
										'uses' => 'RegistroSocialController@ingresoFacebook'
									  ]
		);
		
		/* Ruta para llamado a ingreso por google+ */
		Route::get('ingresogoogle', [
										'as' => 'ingresogoogle',
										'uses' => 'RegistroSocialController@ingresoGoogle'
									]
		);
		
		/* Ruta para llamado a ingreso por twitter */
		Route::get('ingresotwitter', [
										'as' => 'ingresotwitter',
										'uses' => 'RegistroSocialController@ingresoTwitter'
									 ]
		);

	});
	/* FIN MODULO DATOS*/


	/*
	* MODULO USUARIOS PERMISOS Y SEGURIDAD ( miradita/app/controllers/usuariospermisosseguridad )
	* Rutas cuando el usuario no ha iniciado sesión
	*/
	Route::group(array('namespace' => 'usuariospermisosseguridad'), function()
	{
		/* Ruta para activacion de la cuenta después de registro, registro mediante correo */
		Route::get(
					'activar/{random}', 
					'ActivacionCuentaController@activarCuenta'
		);

		/* Ruta para mostrar formulario para solicitar nuevo enlace de activación de cuenta */
		Route::get('solicitar/enlace-de-activacion', [
														'as' => 'nuevoenlaceactivacion', 
														'uses' => 'ActivacionCuentaController@getNuevoEnlace'
													 ]
		);
		
		/* Ruta para generar nuevo enlace de activación de cuenta de usuario */
		Route::post('solicitar/enlace-de-activacion', [
														'as' => 'nuevoenlaceactivacion', 
														'uses' => 'ActivacionCuentaController@postNuevoEnlace'
													  ]
		);

		/* Ruta para activar cuenta de usuario mediante id de usuario y el token de comprobación (random) */
		Route::get('activar/cuenta/{id}/{random}', [
													  'as' => 'activar.cuenta', 
													  'uses' => 'ActivacionCuentaController@getActivarNuevoEnlace'
												   ]
		);


		/*** Rutas para proceso de recuperación de password olvidado ***/
		/* Ruta que muestra formulario para solicitar recuperación de password */
		Route::get('recuperar/acceso', [
										  'as' => 'password.recuperacion', 
										  'uses' => 'RecuperacionPasswordController@getRecuperacionPassword'
									   ]
		);
		
		/* Ruta que genera enlace de recuperación de password */
		Route::post('recuperar/acceso', [
											'as' => 'password.recuperacion', 
											'uses' => 'RecuperacionPasswordController@postRecuperacionPassword'
										]
		);
		
		/* Ruta que muestra formulario para establecer nuevo password después de solicitar recuperación de password */
		Route::get('recuperar/password/{id}/{random}', [
														 'as' => 'password.nuevo', 
														 'uses' => 'RecuperacionPasswordController@getNuevoPassword'
													   ]
		);
		
		/* Ruta para guardar nuevo password */
		Route::post('recuperar/password', [
											 'as' => 'password.nuevo', 
											 'uses' => 'RecuperacionPasswordController@postNuevoPassword'
										  ]
		);	

		
		/*** Rutas para pedir reactivacion de la cuenta después de haber sido borrada ***/
		/* Ruta que muestra formulario para reactivación de cuenta */
		Route::get('reactivar', [
									'as' => 'reactivacioncuenta', 
									'uses' => 'ReactivacionCuentaController@getReactivarCuenta'
								]
		);
		
		/* Ruta para generar enlace de reactivación de cuenta */
		Route::post('reactivar', [
									'as' => 'reactivacioncuenta', 
									'uses' => 'ReactivacionCuentaController@postReactivarCuenta'
								 ]
		);

		/* Ruta para mostrar formulario para establecer nuevo password después de solicitar reactivación de cuenta */
		Route::get('reactivar/nuevopassword/{id}/{random}', [
															  'as' => 'nuevopassword', 
															  'uses' => 'ReactivacionCuentaController@getNuevoPassword']);
		
		/* Ruta para guardar nuevo password para reactivar cuenta de usuario */
		Route::post('reactivar/nuevopassword', [
												  'as' => 'nuevopassword', 
												  'uses' => 'ReactivacionCuentaController@postNuevoPassword'
											   ]
		);
		
	});
	/* FIN MODULO USUARIOS PERMISOS Y SEGURIDAD */