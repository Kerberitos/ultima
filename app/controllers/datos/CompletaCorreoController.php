<?php namespace datos;

use Anuncia\Managers\CorreoSocialManager;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Completar el proceso de registro con social login si API no devuelve correo
 * ----------------------------------------------------
 * Rutas:
 *
 *		- miradita/app/routes/auth.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class CompletaCorreoController extends \BaseController
{
	/* Muestra formulario para ingresar correo y genero si API de red social no devuelve correo*/
	public function getCompletarCorreo()
	{
		return \View::make('modulos.datos.completarcorreo');
	}
	
	/* Procesa formulario para completar correo */
	public function postCompletarCorreo()
	{
		$cuenta = \Auth::user();
		$usuario = $cuenta->usuario;
		
		$manager = new CorreoSocialManager($cuenta, \Input::all());
		
		if ($manager->save())
		{
			$usuario->genero = \Input::get('genero');
			$usuario->save(); 

			return \Redirect::to('/')->with('status_correocompletado', 
											'Su correo se ha guardado correctamente');
			
		}

		return \Redirect::back()->withInput()->withErrors($manager->getErrores());
	}

}