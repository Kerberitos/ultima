<?php

/*
|
|	Rutas dónde se aplica el filtro is_admin
|   Solo usuarios con rol de administrador pueden acceder a estas rutas.
|
|	NOTA IMPORTANTE:
|		- Filtros se encuentran en   miradita/app/filters
|		  
*/

/*
* MODULO ADMINISTRACION ( miradita/app/controllers/administracion )
*/

Route::group(array('namespace' => 'administracion'), function()
	{

	/* Ruta para activar el panel de administrador */
	Route::get('paneladministrador/activar', [
												'as' => 'activar.menu.administrador',
												'uses' => 'AdministradorController@activarMenuAdministrador'
											 ]
	);
	
	/* Ruta para desactivar el panel de administrador */
	Route::get('paneladministrador/desactivar', [
												   'as' => 'desactivar.menu.administrador', 
												   'uses' => 'AdministradorController@desactivarMenuAdministrador'
												]
	);
		
	/* Ruta del panel general de Administrador */
	Route::get('administracion', [
									'as' => 'administracion',
									'uses' => 'AdministradorController@getPanelGeneral'
								 ]
	);
	
	/* Ruta del panel Tareas Pendientes de Administrador */
	Route::get('admin/tareas',[
								'as' => 'admin.pendientes',
								'uses' => 'AdministradorController@getPanelTareasPendientes'
							  ]
	);

	/* lista de administradores del sistema miradita */
	Route::get('administradores/equipo',[
											'as' => 'lista.administradores',
											'uses' => 'AdministradorController@cargarAdministradores'
										]
	);
	
	/* Ruta para ver la información en detalle de un administrador */
	Route::get('ver/detalle/administrador/{id}/{slug}', [
														  'as' => 'admin.veradministrador',
														  'uses' => 'AdministradorController@verAdministrador'
														]
	);

	/*Ruta para presentar la tabla con anuncios que necesitan revision para ser publicados */
	Route::get('admin/anuncios/solicitantes',[
												'as' => 'admin.publicar',
												'uses' => 'AdminAnuncioController@solicitanPublicacion'
											 ]
	);
	
	/*Ruta para llamar a la vista individual de anuncio por revisar */
	Route::get('revisar/anuncio/{seccion}/{anuncio}', [
														'as' => 'admin.revisar',
														'uses' => 'AdminAnuncioController@getRevisarAnuncio'
													  ]
	);

	/*Rutas para activar o rechazar un anuncio que solicitó ser publicado*/
	Route::get('anuncio/activar/{anuncio}', [
												'as' => 'admin.activaranuncio',
												'uses' => 'AdminAnuncioController@activarAnuncio'
											]
	);
	
	Route::post('anuncio/rechazar', [
												'as' => 'admin.rechazaranuncio',
												'uses' => 'AdminAnuncioController@rechazarAnuncio'
											 ]
	);

	/* Ruta para bloquear anuncio por parte del administrador */
	Route::post('anuncio/bloquear', [
												'as' => 'admin.bloquearanuncio',
												'uses' => 'AdminAnuncioController@bloquearAnuncio'
											 ]
	);

	/* Ruta para desbloquear anuncio por parte de administrador o un super admin */
	Route::post('anuncio/desbloquear', [
										'as' => 'admin.desbloquearanuncio',
										'uses' => 'AdminAnuncioController@desbloquearAnuncio'
									]
	);

	/*Ruta para presentar la tabla con anuncios que solicitaron publicación y que están siendo revisados */
	Route::get('admin/anuncios/solicitantes/pendientes',[
														  'as' => 'admin.solicitudes.pendientes',
														  'uses' => 'AdminAnuncioController@solicitanPublicacionPendientes'
														]
	);

	/*Ruta para llamar a al lista de anuncios bloqueados */
	Route::get('admin/anuncios/bloqueados',[
												'as' => 'admin.anuncios.bloqueados',
												'uses' => 'AdminAnuncioController@mostrarAnunciosBloqueados'
											]
	);	

	/*Ruta para visualizar detalle de anuncio bloqueado */
	Route::get('revisar/anuncios/bloqueados/{seccion}/{anuncio}',[
												'as' => 'admin.revisaranuncio.bloqueado',
												'uses' => 'AdminAnuncioController@revisarAnuncioBloqueado'
											]
	);

	/*Ruta para presentar el historial de anuncio bloqueado*/
	Route::get('admin/ver/historial/anuncio/{anuncio}',[
												'as' => 'admin.ver.historialanuncio',
												'uses' => 'AdminAnuncioController@mostrarHistorialAnuncio'
											 ]
	);



	/* Ruta para llamar a lista de usuarios bloqueados que puede ver un administrador */
	Route::get('admin/usuarios/bloqueados', [
												'as' => 'admin.usuarios.bloqueados', 
												'uses' => 'AdminUsuariosController@mostrarUsuariosBloqueados'
											]
	);
	
	/* Ruta para visualizar la información detallada de un usuario bloqueado */
	Route::get('admin/ver/detalle/usuario-bloqueado/{id}', [
															  'as'=>'admin.verusuariobloqueado', 
															  'uses'=>'AdminUsuariosController@verUsuarioBloqueado'
														   ]
	);

	/* Ruta para llamar a lista de usuarios desactivados que puede ver un administrador */
	Route::get('admin/usuarios/desactivados', [
												 'as' => 'admin.usuarios.desactivados',
												 'uses' => 'AdminUsuariosController@mostrarUsuariosDesactivados'
											  ]
	);
	
	/* Ruta para visualizar la información detallada de un usuario desactivado */
	Route::get('admin/ver/detalle/usuario-desactivado/{id}', [
																'as' => 'admin.verusuariodesactivado',
																'uses' => 'AdminUsuariosController@verUsuarioDesactivado'
															 ]
	);


	/* Ruta para responder un mensaje de contactanos */
	Route::get('admin/correoautomatizado/{user_id}',[
														  'as' => 'enviar.correo.automatizado', 
														  'uses' => 'AdminUsuariosController@enviarCorreoAutomatizado'
														]
	);


	/* Ruta para activar cuenta de usuario desactivada */
	Route::get('admin/activar/cuenta/usuario/{id}', [
														'as' => 'admin.activarcuentausuario',
														'uses' => 'AdminUsuariosController@activarCuentaDesactivada'
													]
	);

	/*Ruta para presentar la tabla con anuncios denunciados que necesitan revision*/
	Route::get('admin/anuncios/denunciados', [
												'as' => 'admin.revisar.denuncias',
												'uses' => 'AdminDenunciaController@mostrarAnunciosDenunciados'
											 ]
	);

	/*Ruta para presentar la tabla con anuncios denunciados pendientes, anuncios que está revisando un administrador*/
	Route::get('admin/anuncios/denunciados/pendientes', [
														  'as' => 'admin.denunciados.pendientes',
														  'uses' => 'AdminDenunciaController@mostrarAnunciosDenunciadosPendientes'
														]
	);

	/* Ruta para visualizar el anuncio detallado, donde el admin puede aprobar o rechazar la denuncia*/
	Route::get('revisar/denunciado/{seccion}/{anuncio}', [
															'as' => 'admin.revisaranuncio.denunciado',
															'uses' => 'AdminDenunciaController@revisarAnuncioDenunciado'
														 ]
	);

	/* Ruta para aprobar la denuncia sobre el anuncio, si la denuncia es verdadera se bloquea el anuncio */
	Route::post('denuncia/aprobar', [
										'as' => 'aprobardenuncia', 
										'uses' => 'AdminDenunciaController@aprobarDenuncia'
									]
	);

	/* Ruta para rechazar la denuncia sobre el anuncio, si la denuncia es falsa se reactiva el anuncio */
	Route::post('denuncia/rechazar', [
										'as' => 'rechazardenuncia', 
										'uses' => 'AdminDenunciaController@rechazarDenuncia'
									 ]
	);

	/*Ruta para presentar la tabla con comentarios denunciados que necesitan revision*/
	Route::get('admin/comentarios/denunciados', [
													'as' => 'admin.revisar.comentarios.denunciados', 
													'uses' => 'AdminComentarioController@mostrarComentariosDenunciados'
												]
	);
	
	/*Ruta para presentar la tabla con comentarios denunciados pendientes, comentarios que está revisando un administrador*/
	Route::get('admin/comentarios/pendientes', [
												  'as' => 'admin.revisar.comentarios.pendientes',
												  'uses' => 'AdminComentarioController@mostarComentariosDenunciadosPendientes'
											   ]
	);

	/* Ruta para visualizar el comentario detallado, donde el admin puede aprobar o rechazar la denuncia del comentario*/
	Route::get('admin/revisar/comentario/{comentario_id}', [
															  'as' => 'admin.revisarcomentario',
															  'uses' => 'AdminComentarioController@revisarComentarioDenunciado'
														   ]
	);

	/* Ruta para aprobar la denuncia sobre el comentario, si la denuncia es verdadera se elimina el comentario */
	Route::post('denuncia/comentario/aprobar', [
												  'as' => 'aprobardenunciacomentario',
												  'uses' => 'AdminComentarioController@aprobarDenunciaComentario'
											   ]
	);

	/* Ruta para rechazar la denuncia sobre el comentario, si la denuncia es falsa se reactiva el comentario */
	Route::post('denuncia/comentario/rechazar', [
												  'as' => 'rechazardenunciacomentario',
												  'uses' => 'AdminComentarioController@rechazarDenunciaComentario'
												]
	);

	/*Ruta para presentar la tabla con respuestas denunciadas que necesitan revision*/
	Route::get('admin/respuestas/denunciadas', [
												  'as' => 'admin.revisar.respuestas.denunciadas',
												  'uses'  => 'AdminRespuestaController@mostrarRespuestasDenunciadas'
											   ]
	);

	/*Ruta para presentar la tabla con respuestas denunciadas pendientes, respuestas que está revisando un administrador */
	Route::get('admin/respuestas/pendientes', [
												  'as' => 'admin.revisar.respuestas.pendientes',
												  'uses' => 'AdminRespuestaController@mostrarRespuestasDenunciadasPendientes'
											  ]
	);
	
	/* Ruta para visualizar la respuesta, donde el admin puede aprobar o rechazar la denuncia de la respuesta */
	Route::get('admin/revisar/respuesta/{respuesta_id}', [
															'as' => 'admin.revisarrespuesta',
															'uses' => 'AdminRespuestaController@revisarRespuestaDenunciada'
														 ]
	);

	/* Ruta para aprobar la denuncia sobre la respuesta, si la denuncia es verdadera se elimina la respuesta */		
	Route::post('denuncia/respuesta/aprobar', [
												'as' => 'aprobardenunciarespuesta',
												'uses' => 'AdminRespuestaController@aprobarDenunciaRespuesta'
											  ]
	);
	
	/* Ruta para rechazar la denuncia sobre la respuesta, si la denuncia es falsa se reactiva la respuesta */
	Route::post('denuncia/respuesta/rechazar',  [
												  'as' => 'rechazardenunciarespuesta',
												  'uses' => 'AdminRespuestaController@rechazarDenunciaRespuesta'
												]
	);

	/*Ruta para presentar la tabla con mensajes recibidos a través de contactanos */
	Route::get('admin/mensajes-contactanos', [
												'as' => 'admin.msmcontactanos', 
												'uses' => 'AdminContactanosController@mostrarMensajesContactanos'
											 ]
	);
	
	/* Ruta para ver el mensaje contactanos de forma individual */
	Route::get('admin/msmcontactanos/{id}', [
												'as' => 'admin.revisar.msmcontactanos',
												'uses' => 'AdminContactanosController@revisarMensajeContactanos'
											]
	);

	/* Ruta para verificar si el correo está asociado a alguna cuenta y el estado que posee la cuenta de usuario */
	Route::get('admin/verificar/cuenta/{id}/',  [
												   'as' => 'admin.verificar.cuenta',
												   'uses' => 'AdminContactanosController@verificarCuenta'
												]
	);
	
	/* Ruta para eliminar un mensaje de contactanos */
	Route::get('eliminar/mensaje-contactanos/{id}',[
													 'as' => 'eliminarmensajecontactanos',
													 'uses' => 'AdminContactanosController@eliminarMensajeContactanos'
												   ]
	);

	/* Ruta para responder un mensaje de contactanos */
	Route::get('admin/respuesta/{user_id}/{mensaje_id}',[
														  'as' => 'enviar.respuesta.contactanos', 
														  'uses' => 'AdminContactanosController@responderContactanos'
														]
	);
});
		
/* FIN MODULO ADMINISTRACION */