<?php
	
/*
|
|	Rutas dónde no se aplica ningún filtro 
|   (No hay necesidad de que usuario inicie sesión -ingresar- a la aplicación)
|	Cualquiera que navegue por la aplicación puede acceder a estas rutas
|
|	NOTA IMPORTANTE:
|		- MainController no se encuentra en incluido en ningún módulo, es el Controller principal
|		
|	
*/

	/*
	* Rutas para MainController.php ( miradita/app/controllers/MainController.php )
	*/

	/* Ruta para llamar al main (vista inicial) de la app */
	Route::get('/', [
						'as' => 'main', 
						'uses' => 'MainController@getMain'
					]
	);

	/* Ruta que permite visualizar los anuncios Clasificados */
	Route::get('clasificados', [
								  'as' => 'verclasificados', 
								  'uses' => 'MainController@verAnunciosClasificados'
							   ]
	);
	
	/* Ruta que permite visualizar los anuncios sobre ServiciosClasificados */
	Route::get('servicios', [
								'as' => 'verservicios', 
								'uses' => 'MainController@verAnunciosServicios'
							]
	);
	
	/* Ruta que permite visualizar los anuncios sobre Empleos */
	Route::get('empleos', [
							'as' => 'verempleos', 
							'uses' => 'MainController@verAnunciosEmpleos'
						  ]
	);

	/* Ruta que muestra todas las categorías de Clasificados */
	Route::get('clasificados/categorias', [
											'as' => 'clasificados.categorias', 
											'uses' => 'MainController@verCategoriasDeClasificados'
										  ]
	);
	
	/* Ruta que muestra todas las categorías de Servicios */
	Route::get('servicios/categorias', [
											'as' => 'servicios.categorias', 
											'uses' => 'MainController@verCategoriasDeServicios'
									   ]
	);
	
	/* Ruta que muestra todas las categorías de Empleos */
	Route::get('empleos/categorias', [
										'as' => 'empleos.categorias', 
										'uses' => 'MainController@verCategoriasDeEmpleos'
									 ]
	);




	/*
	* MODULO ANUNCIOS ( miradita/app/controllers/anuncios )
	*/
	Route::group(array('namespace' => 'anuncios'), function()
	{
		/* Ruta para mostrar en detalle un anuncio */
		Route::get('ver/anuncio/{seccion}/{anuncio}', [
														'as' => 'veranuncio', 
														'uses' => 'VisualizaAnuncioController@verAnuncio'
													  ]
		);
	});	
	/* FIN MODULO ANUNCIOS */




	/*
	* MODULO BUSQUEDA ( miradita/app/controllers/busqueda )
	*/
	Route::group(array('namespace' => 'busqueda'), function()
	{

		/* Ruta que permite realizar busqueda de anuncios mediante palabras claves (full-text) */
		Route::get('buscar/anuncio', [
										'as' => 'busqueda', 
										'uses' => 'BusquedaAnuncioController@busquedaDeAnuncios'
									 ]
		);

		/* Ruta para mostrar anuncios clasificados por categoria seleccionada */
		Route::get('clasificados/{categoria}', [
												  'as' => 'clasificados.categoria.n', 
												  'uses' => 'BusquedaPorCategoriaController@buscarClasificadosCategoriaN'
											   ]
		);
		
		/* Ruta para mostrar anuncios sobre servicios por categoria seleccionada */
		Route::get('servicios/{categoria}', [
											  'as' => 'servicios.categoria.n', 
											  'uses' => 'BusquedaPorCategoriaController@buscarServiciosCategoriaN'
											]
		);
		
		/* Ruta para mostrar anuncios sobre empleos por categoria seleccionada */
		Route::get('empleos/{categoria}', [
											'as' => 'empleos.categoria.n', 
											'uses' => 'BusquedaPorCategoriaController@buscarEmpleosCategoriaN'
										  ]
		);

		/* Ruta para mostrar anuncios clasificados por subcategoria seleccionada */
		Route::get('clasificados/{categoria}/{subcategoria}', [
																'as' => 'clasificados.subcategoria.n', 
																'uses' => 'BusquedaPorSubcategoriaController@buscarClasificadosSubcategoriaN'
															  ]
		);
		
		/* Ruta para mostrar anuncios sobre servicios por subcategoria seleccionada */
		Route::get('servicios/{categoria}/{subcategoria}', [
															  'as' => 'servicios.subcategoria.n', 
															  'uses' => 'BusquedaPorSubcategoriaController@buscarServiciosSubcategoriaN'
														   ]
		);
		
		/* Ruta para mostrar anuncios sobre empleos por subcategoria seleccionada */
		Route::get('empleos/{categoria}/{subcategoria}', [
															'as' => 'empleos.subcategoria.n', 
															'uses' => 'BusquedaPorSubcategoriaController@buscarEmpleosSubcategoriaN'
														 ]
		);

	});		
	/* FIN MODULO BUSQUEDA */



	/*
	* MODULO AYUDA ( miradita/app/controllers/ayuda )
	*/
	Route::group(array('namespace' => 'ayuda'), function()
	{
	
		/* Ruta para llamar a la pagina inicial de la ayuda */
		Route::get('ayuda/intro', [
									  'as' => 'ayuda',
									  'uses' => 'AyudaController@verPaginaPrincipalAyuda'
								  ]
		);	
			
		/* Ruta para llamar la pagina sobre Registro e inicio de sesión */
		Route::get('ayuda/registro-e-ingreso', [
												  'as' => 'ayuda.pagina2',
												  'uses' => 'AyudaController@verPagina2'
											   ]
		);
	
		/* Ruta para llamar la pagina sobre Perfil y cuenta de usuario */
		Route::get('ayuda/perfil-y-cuenta', [
												'as' => 'ayuda.pagina3',
												'uses' => 'AyudaController@verPagina3'
											]
		);
		
		/* Ruta para llamar la pagina sobre Tipos de anuncios */
		Route::get('ayuda/tipos-de-anuncios', [
												'as' => 'ayuda.pagina4',
												'uses' => 'AyudaController@verPagina4'
											  ]
		);
		
		/* Ruta para llamar la pagina sobre Crear y publicar anuncios */
		Route::get('ayuda/crear-publicar-anuncio', [
													   'as' => 'ayuda.pagina5',
													   'uses' => 'AyudaController@verPagina5'
												   ]
		);
		
		/* Ruta para llamar la pagina sobre Gestiona tus anuncios */
		Route::get('ayuda/gestion-anuncios', [
												'as' => 'ayuda.pagina6',
												'uses' => 'AyudaController@verPagina6'
											 ]
		);
		
		/* Ruta para llamar la pagina sobre Comunicación */
		Route::get('ayuda/sistema-comunicacion', [
													'as' => 'ayuda.pagina7',
													'uses' => 'AyudaController@verPagina7'
												 ]
		);

		/* Ruta que muestra los Términos y condiciones de uso de la aplicación */
		Route::get('politicas-de-uso', [
								'as' => 'politicas', 
								'uses' => 'AyudaController@verPoliticas'
							 ]
		);
	
	});		
	/* FIN MODULO AYUDA*/



	/*
	* MODULO COMUNICACIONYNOTIFICACIONES ( miradita/app/controllers/comunicacionynotificaciones )
	*/
	Route::group(array('namespace' => 'comunicacionynotificaciones'), function()
	{
		
		/* Ruta para mostrar formulario Contáctanos */
		Route::get('contactanos', [
									'as' => 'contactanos',
									'uses' => 'ContactanosController@verFormularioContactanos'
								  ]
		);

		/* Ruta para enviar mensaje desde contáctanos a Administradores */
		Route::post('contactar', [
									'as' => 'contactaradmin',
									'uses' => 'ContactanosController@enviarMensajeDesdeContactanos'
								 ]
		);

	});
	/* FIN MODULO COMUNICACIONYNOTIFICACIONES*/