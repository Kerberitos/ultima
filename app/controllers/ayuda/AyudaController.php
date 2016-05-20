<?php namespace ayuda;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Visualizar un manual de ayuda al usuario
 *		- Visualizar los Términos y condiciones de uso de la aplicación web
 * ----------------------------------------------------
 * Rutas:
 * 		- miradita/app/routes/basicas.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class AyudaController extends \BaseController
{
	
	/* Muestra los Términos y Condiciones de Uso de la aplicación */
	public function verPoliticas()
	{
		return \View::make('modulos.ayuda.politicasdeuso');
	}


	/* Visualiza la pagina principal(inicial) de la ayuda */
	public function verPaginaPrincipalAyuda(){
		return \View::make('modulos.ayuda.mainayuda');
	}

	/* Visualiza la pagina sobre Registro e inicio de sesión */
	public function verPagina2()
	{
		return \View::make('modulos.ayuda.internas.pagina2');
	}
	
	/* Visualiza la pagina sobre Perfil y cuenta de usuario */
	public function verPagina3()
	{
		return \View::make('modulos.ayuda.internas.pagina3');
	}
	
	/* Visualiza la pagina sobre Tipos de anuncios */
	public function verPagina4()
	{
		return \View::make('modulos.ayuda.internas.pagina4');
	}
	
	/* Visualiza la pagina sobre Crear y publicar anuncios */
	public function verPagina5()
	{
		return \View::make('modulos.ayuda.internas.pagina5');
	}
	
	/* Visualiza la pagina sobre Gestiona tus anuncios */
	public function verPagina6()
	{
		return \View::make('modulos.ayuda.internas.pagina6');
	}
	
	/* Visualiza la pagina sobre Comunicación */
	public function verPagina7()
	{
		return \View::make('modulos.ayuda.internas.pagina7');
	}
}
