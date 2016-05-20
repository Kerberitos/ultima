<?php

/*
|
|	Rutas dónde no se aplica el filtro Auth
|   Solo usuarios que iniciaron sesión en la aplicación pueden acceder a estas rutas.
|
|	NOTA IMPORTANTE:
|		- ComentarioController no se incluye en Módulo Comunicacionynotificaciones 
|		  porque el namespace no permite el envío de los comentarios mediante ajax		
|		  
*/
	
	/*
	* MODULO ANUNCIOS ( miradita/app/controllers/anuncios )
	* Rutas cuando el usuario ha iniciado sesión
	*/
	Route::group(array('namespace' => 'anuncios'), function()
	{
		/* Ruta que muestra el primer paso para crear anuncio*/
		Route::get('crear/anuncio', [
										'as' => 'mostrar.pasouno', 
									 	'uses' => 'CreacionAnuncioController@mostrarPasoUno'
									]
		);
		
		/* Ruta para rellenar el select de categoria */
		Route::post('crear/categorias', [
											'as' => 'categorias', 
											'uses' => 'CreacionAnuncioController@categorias'
										]
		);
		
		/* Ruta para rellenar el select de subcategoría */
		Route::post('crear/subcategorias',  [
												'as' => 'subcategorias', 
												'uses' => 'CreacionAnuncioController@subcategorias'
											]
		);
		
		/* Ruta para rellenar el select de opcion */
		Route::post('crear/opcion', [
										'as' => 'opcion', 
										'uses' => 'CreacionAnuncioController@opcion'
									]
		);

		/* Ruta par enviar datos desde paso uno para mostrar formulario crear anuncio*/
		Route::post('crear/anuncio', [
										'as' => 'enviar.pasouno', 
										'uses' => 'CreacionAnuncioController@enviarPasoUno'
									 ]
		);

		/* Ruta que muestra formulario crear anuncio*/
		Route::get('crear/anuncio/{seccion}/{categoria}/{subcategoria}/{opcion}', [
																					'as' => 'mostrar.formulario', 
																					'uses' => 'CreacionAnuncioController@mostrarFormulario'
																				  ]
		);
		
		/* Ruta para guardar anuncio clasificado*/
		Route::post('clasificadocreado', [
											'as' => 'clasificadocreado', 
											'uses' => 'CreacionAnuncioController@postClasificado'
										 ]
		);
		
		/* Ruta para guardar anuncio sobre servicio*/
		Route::post('serviciocreado', [
										'as' => 'serviciocreado',
										'uses' => 'CreacionAnuncioController@postServicio'
									  ]
		);
		
		/* Ruta para guardar anuncio sobre empleo*/
		Route::post('empleocreado', [
										'as' => 'empleocreado',
										'uses' => 'CreacionAnuncioController@postEmpleo'
									]
		);

		/*Ruta para llamar a mis anuncios*/	
		Route::get('misanuncios', [
									'as' => 'misanuncios',
									'uses' => 'GestionAnuncioController@mostrarMisAnuncios'
								  ]
		);

		/*Ruta para solicitar publicación después de crear anuncio*/
		Route::get('anuncio/solicitud/publicar/{anuncio_id}', [
																'as' => 'mostrar.solicitud.publicacion',
																'uses' => 'GestionAnuncioController@mostrarSolicitudPublicacion'
															  ]
		);

		/*Ruta para enviar la solicitud de publicación*/
		Route::get('anuncio/publicar/{anuncio}', [
													'as' => 'enviar.solicitud.publicacion',
													'uses' => 'GestionAnuncioController@enviarSolicitudPublicacion'
												 ]
		);

		/* Ruta para eliminar Anuncio*/
		Route::get('anuncio/eliminar/{anuncio}', [
													'as' => 'eliminaranuncio',
													'uses' => 'GestionAnuncioController@eliminarAnuncio'
												 ]
		);
		
		/* Ruta para desactivar Anuncio*/
		Route::get('anuncio/desactivar/{anuncio}', [
													  'as' => 'desactivaranuncio',
													  'uses' => 'GestionAnuncioController@desactivarAnuncio'
												   ]
		);
		
		/*Ruta para mostrar formulario editar anuncio*/
		Route::get('anuncio/editar/{anuncio}',  [
													'as' => 'mostrar.formulario.edicion',
													'uses' => 'EdicionAnuncioController@mostrarFormularioEdicion'
												]
		);

		/*Ruta para guardar modificacion de anuncio clasificado*/
		Route::put('anuncio/editar/clasificado', [
													'as' => 'editarclasificado',
													'uses' => 'EdicionAnuncioController@editarClasificado'
												 ]
		);
		
		/* Ruta para guardar modificacion de anuncio sobre empleo*/
		Route::put('anuncio/editar/empleo', [
												'as' => 'editarempleo',
												'uses' => 'EdicionAnuncioController@editarEmpleo'
											]
		);

		/* Ruta para guardar modificacion de anuncio sobre servicio*/
		Route::put('anuncio/editar/servicio', [
												'as' => 'editarservicio',
												'uses' => 'EdicionAnuncioController@editarServicio'
											  ]
		);
		
		/* Ruta para denunciar un anuncio */
		Route::post('anuncio/denunciar', [
											'as' => 'denunciaranuncio',
											'uses' => 'DenunciaController@denunciarAnuncio'
										 ]
		);

		/*Ruta para denunciar un comentario*/
		Route::get('anuncio/comentario/denunciar/{id}/{denunciado_id}', [	
																			'as' => 'denunciarcomentario', 
																			'uses' => 'DenunciaController@denunciarComentario'
																		]
		);
		
		/*Ruta para denunciar una respuesta*/
		Route::get('anuncio/respuesta/denunciar/{id}/{denunciado_id}', [
																		   'as' => 'denunciarrespuesta',
																		   'uses' => 'DenunciaController@denunciarRespuesta'
																	    ]
		);
	});
	/* FIN MODULO ANUNCIOS*/

	
	

	/*
	* MODULO COMUNICACIONYNOTIFICACIONES ( miradita/app/controllers/comunicacionynotificaciones )
	* Rutas cuando el usuario ha iniciado sesión
	*/
	Route::group(array('namespace' => 'comunicacionynotificaciones'), function()
	{
		
		/* Ruta para visualizar agenda de usuario */
		Route::get('ver/agenda', [
									'as' => 'miagenda',
									'uses' => 'AgendaController@mostrarMiAgenda'
								 ]
		);
		
		/* Ruta para ver la información en detalle de un contacto */
		Route::get('ver/detalle/contacto/{id}', [
													'as' => 'vercontacto',
													'uses' => 'AgendaController@verContacto'
												]
		);

		/* Ruta para agregar contacto a Agenda */
		Route::post('agendar/{anunciante_id}', [
												 'as' => 'agendar',
												 'uses' => 'AgendaController@agregarContactoAgenda'
											  ]
		);
		
		/* Ruta para eliminar contacto de Agenda */
		Route::get('eliminar/contacto/{contacto_id}', [
														'as' => 'eliminarcontacto',
														'uses' => 'AgendaController@eliminarContactoAgenda']
		);



		/* Ruta para enviar mensaje */
		Route::post('mensajes', [
									'as' => 'enviarmensaje',
									'uses' => 'MensajeController@enviarMensaje'
								]
		);
		
		/*Rutas para visualizar los mensajes dentro de la app*/
		Route::get('ver/mensajes',  [
										'as' => 'mismensajes', 
										'uses' => 'MensajeController@mostrarMensajes'
									]
		);
		
		/* Ruta para visualizar un mensaje en detalle */
		Route::get('leer/mensaje/{id}', [
											'as' => 'leermensaje',
											'uses' => 'MensajeController@revisarMensaje'
										]
		);

		/* Ruta para eliminar mensaje */
		Route::get('eliminar/mensaje/{id}', [
												'as' => 'eliminarmensaje',
												'uses' => 'MensajeController@eliminarMensaje'
											]
		);



		/* Ruta para visualizar las notificaciones */
		Route::get('ver/notificaciones', [
											'as' => 'misnotificaciones',
											'uses' => 'NotificacionController@mostrarNotificaciones'
										 ]
		);

		/* Ruta para visualizar una notificación en detalle*/
		Route::get('ver/notificacion/{id}', [
												'as' => 'vernotificacion',
												'uses' => 'NotificacionController@revisarNotificacion'
											]
		);
	});
	/* FIN MODULO COMUNICACIONYNOTIFICACIONES */




	/*
	* MODULO DATOS ( miradita/app/controllers/datos )
	* Rutas cuando el usuario ha iniciado sesión
	*/
	Route::group(array('namespace' => 'datos'), function()
	{
		/* Rutas para el proceso de salir (cerrar sesión) de la aplicación */
		Route::get('salir', [
								'as' => 'salir',
								'uses' => 'AutenticacionController@salir'
							]
		);
		

		/* Ruta para visualizar formulario de completar correo y genero después de ingreso Social Login*/
		Route::get('agregar/correo', [
										'as' => 'completarcorreo',
										'uses' => 'CompletaCorreoController@getCompletarCorreo'
									 ]
		);
		
		/* Ruta para agregar correo y genero después de ingreso con Social Login */
		Route::post('agregar/correo', [
										'as' => 'completarcorreo',
										'uses' => 'CompletaCorreoController@postCompletarCorreo'
									  ]
		);


		/* Ruta para mostrar perfil de usuario */
		Route::get('perfil/{slug}', [
										'as' => 'perfil',
										'uses' => 'PerfilController@getPerfil'
									]
		);

		/* Ruta para mostrar formulario para cambiar la foto de perfil */
		Route::get('perfil/{slug}/editar-foto', [
													'as' => 'edicionfoto',
													'uses' => 'PerfilController@getEditarFoto'
												]
		);
		
		/* Ruta para procesar el cambio de foto de perfil */
		Route::post('perfil/{slug}/editar-foto', [
													'as' => 'edicionfoto',
													'uses' => 'PerfilController@postEditarFoto'
												 ]
		);


		/* Ruta para mostrar formulario de edicion de datos generales en perfil */
		Route::get('perfil/{slug}/editar-datos', [
													'as' => 'ediciondatos', 
													'uses' => 'EdicionDatosController@getEditarDatos'
												 ]
		);
		
		/* Ruta para editar datos generales de usuario */
		Route::post('perfil/{slug}/editar-datos', [
													'as' => 'ediciondatos',
													'uses' => 'EdicionDatosController@postEditarDatos'
												  ]
		);


		/* Ruta para mostrar formulario de edicion de cuenta de usuario */
		Route::get('perfil/{slug}/editar-cuenta', [
													'as' => 'edicioncuenta',
													'uses' => 'EdicionCuentaController@getEdicionCuenta'
												  ]
		);
		
		/* Ruta para editar cuenta de usuario */
		Route::post('perfil/{slug}/editar-cuenta',  [
													  'as' => 'edicioncuenta',
													  'uses' => 'EdicionCuentaController@postEdicionCuenta'
													]
		);


		/* Ruta para mostrar formulario cambiar contraseña de la cuenta de usuario */
		Route::get('password/cambiar', [
										  'as' => 'cambiarpassword',
										  'uses' => 'ModificaPasswordController@getCambiarPassword']
		);
		
		/* Ruta para procesar formulario cambiar contraseña de la cuenta de usuario */
		Route::post('password/cambiar', [
											'as' => 'cambiarpassword',
											'uses' => 'ModificaPasswordController@postCambiarPassword'
										]
		);
		
		/* Ruta para mostrar formulario fijar una contraseña (cuando usuario se registró previamente con social login) */
		Route::get('password/fijar', [
										'as' => 'fijarpassword',
										'uses' => 'ModificaPasswordController@getFijarPassword'
									 ]
		);
		
		/* Ruta para procesar formulario fijar una contraseña (cuando usuario se registró previamente con social login) */
		Route::post('password/fijar', [
										 'as' => 'fijarpassword',
										 'uses' => 'ModificaPasswordController@postFijarPassword'
									  ]
		);
		
		
		/* Ruta muestra formulario para eliminar cuenta de usuario */
		Route::get('eliminarmicuenta/{slug}', [
												'as' => 'bajacuenta',
												'uses' => 'EliminaCuentaController@getBajarCuenta'
											  ]
		);
		
		/* Ruta para eliminar cuenta de usuario registrado con correo*/
		Route::post('eliminarmicuenta/{slug}',  [
												  'as' => 'bajacuenta',
												  'uses' => 'EliminaCuentaController@postBajarCuenta'
												]
		);
		
		/* Ruta para eliminar cuenta de usuario registrado con Social login*/
		Route::post('bajacuenta', [
									'as' => 'bajacuentasocial',
									'uses' => 'EliminaCuentaController@postBajarCuentaSocial'
								  ]
		);
		
	});
	/* FIN MODULO DATOS */




	/*
	* MODULO USUARIOS-PERMISOS Y SEGURIDAD ( miradita/app/controllers/usuariospermisosseguridad )
	* Rutas cuando el usuario ha iniciado sesión
	*/
	Route::group(array('namespace' => 'usuariospermisosseguridad'), function()
	{
		/* ruta para postular como administrador en miradita */
		Route::get('perfil/postular/administrador', [
													   'as' => 'postular',
													   'uses' => 'SolicitudParaAdminController@postularAdministrador'
													]
		);	
	});
	/* FIN MODULO USUARIOS-PERMISOS Y SEGURIDAD */




	/*
	* Rutas para ComentarioController.php ( miradita/app/controllers/ComentarioController.php )
	* Rutas cuando el usuario ha iniciado sesión
	*/
	
	/* Ruta para crear comentario en un anuncio */
	Route::post('ver/anuncio/{seccion}/{anuncio}/comentario', [
																  'as'=>'comentario',
																  'uses'=>'ComentarioController@comenta'
															  ]
	);
	
	/* Ruta para crear respuesta en un comentario de anuncio */
	Route::post('ver/anuncio/{seccion}/{anuncio}/respuesta', [
																'as'=>'respuesta',
																'uses'=>'ComentarioController@respuesta'
															 ]
	);
	
	/* Ruta para borrar comentario */
	Route::get('anuncio/comentario/borrar/{comentario_id}', [
																'as'=>'borrarcomentario',
																'uses'=>'ComentarioController@borrarcomentario'
															]
	);
	
	/* Ruta para borrar respuesta de un comentario */
	Route::get('anuncio/respuesta/borrar/{respuesta_id}', [
															'as'=>'borrarrespuesta',
															'uses'=>'ComentarioController@borrarrespuesta'
														  ]
	);
	/* Fin Rutas para ComentarioController */




	
	
	
