<?php

/*
|
|	Rutas dónde se aplica el filtro is_super
|   Solo usuarios con rol de Super administrador pueden acceder a estas rutas.
|
|	NOTA IMPORTANTE:
|		- Filtros se encuentran en   miradita/app/filters
|		  
*/

/*
* MODULO SUPER ( miradita/app/controllers/super )
*/
Route::group(array('namespace' => 'super'), function()
{
		
	/* Ruta para visualizar el panel de Sistema */
	Route::get('super/sistema/',  [ 
									'as' => 'super.system', 
									'uses' => 'SistemaController@panelSistema'
								  ]
	);
		
	/* Ruta que muestra notificaciones expiradas  */
	Route::get('super/notificaciones', [
										  'as' => 'super.notificaciones', 
										  'uses' => 'SuperNotificacionController@notificacionesExpiradas'
									   ]
	);

	/* Ruta que elimina notificaciones expiradas */
	Route::get('super/elimina/notificaciones', [
												  'as' => 'eliminar.notificaciones.expiradas',
												  'uses' => 'SuperNotificacionController@eliminarNotificacionesExpiradas'
											   ]
	);

	/* Ruta que muestra anuncios expirados */
	Route::get('super/anuncios/', [
									'as' => 'super.anuncios',
									'uses' => 'SuperAnuncioController@anunciosExpirados'
								  ]
	);



	/* Ruta que muestra anuncios ocupados por un administrador */
	Route::get('super/anuncios/ocupados', [
									'as' => 'super.anuncios.ocupados',
									'uses' => 'SuperAnuncioController@anunciosOcupados'
								  ]
	);

	/* Ruta que liberar anuncios ocupados */
	Route::get('super/liberar/anuncios', [
											  'as' => 'liberar.anuncios.ocupados',
											  'uses' => 'SuperAnuncioController@liberarAnunciosOcupados'
										   ]
	);


	/* Ruta que desactiva anuncios expirados */
	Route::get('super/desactiva/anuncios', [
											  'as' => 'desactivar.anuncios.expirados',
											  'uses' => 'SuperAnuncioController@desactivarAnunciosExpirados'
										   ]
	);
		
	/* Ruta para mostrar configuración del sistema */
	Route::get('admin/super/configuraciones/', [
												  'as' => 'super.configuraciones',
												  'uses' => 'ConfiguracionController@verConfiguracion'
											   ]
	);
		
	/* Ruta para guardar configuración del sistema*/
	Route::post('admin/super/configuracion', [
												'as' => 'guardar.configuracion',
												'uses' => 'ConfiguracionController@guardarConfiguracion'
											 ]
	);

	/* Ruta para mostrar el Panel de usuarios para super administrador */
	Route::get('admin/super/usuarios/', [
										  'as' => 'super.usuarios',
										  'uses' => 'SuperUsuariosController@panelUsuarios'
										]
	);
	
	/* Ruta para mostrar lista de usuarios postulantes a administradores */
	Route::get('super/usuarios/postulantes/', [
												'as' => 'lista.usuarios.postulantes',
												'uses' => 'SuperUsuariosController@usuariosPostulantes'
											  ]
	);

	/* Ruta para mostrar detalle de usuario postulante a administrador */
	Route::get('admin/super/verpostulante/{id}', [
													'as' => 'ver.postulante',
													'uses' => 'SuperUsuariosController@verPostulante'
												 ]
	);

	/* Ruta para mostrar lista de usuarios bloqueados */
	Route::get('super/usuarios/bloqueados/', [
												'as' => 'lista.usuarios.bloqueados', 
												'uses' => 'SuperUsuariosController@usuariosBloqueados'
											 ]
	);
	
	/* Ruta para mostrar lista de usuarios desactivados */	
	Route::get('super/usuarios/desactivados/',  [
													'as' => 'lista.usuarios.desactivados', 
													'uses' => 'SuperUsuariosController@usuariosDesactivados'
												]
	);
		
	/* Ruta para mostrar lista de usuarios activos */
	Route::get('super/usuarios/activos/', [
											'as' => 'lista.usuarios.activos', 
											'uses' => 'SuperUsuariosController@usuariosActivos'
										  ]
	);
	
	/* Ruta para mostrar detalle de usuario bloqueado, desactivado o activado */
	Route::get('super/ver/usuario/{id}', [
											'as' => 'super.ver.usuario', 
											'uses' => 'SuperUsuariosController@verUsuario'
										 ]
	);

	/* Ruta para ascender usuario a administrador */
	Route::get('super/ascender/administrador/{id}', [
														'as' => 'ascender.administrador', 
														'uses' => 'SuperGestionUsuariosController@ascenderAAdministrador'
													]
	);

	/* Ruta para rechazar solicitud de usuario para ascender a administrador */
	Route::get('super/rechazar/solicitud/{id}', [
												  'as' => 'rechazar.solicitud', 
												  'uses' => 'SuperGestionUsuariosController@rechazarSolicitudAPostulante'
												]
	);
	
	/* Ruta para ascender administrador a super administrador */
	Route::get('super/ascender/super/{id}', [
											   'as' => 'ascender.super', 
											   'uses' => 'SuperGestionUsuariosController@ascenderASuperadministrador'
											]
	);

	/* Ruta para descender un Super-administrador a administrador */
	Route::get('super/descender/administrador/{id}', [
														'as' => 'descender.administrador', 
														'uses' => 'SuperGestionUsuariosController@descenderAAdministrador'
													 ]
	);

	/* Ruta para descender un Superadministrador o administrador a rol de usuario*/
	Route::get('super/descender/usuario/{id}', [
												  'as' => 'descender.usuario', 
												  'uses' => 'SuperGestionUsuariosController@descenderAUsuario'
											   ]
	);

});
/* FIN MODULO SUPER*/