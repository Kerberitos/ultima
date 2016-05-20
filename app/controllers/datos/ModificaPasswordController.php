<?php namespace datos;

use Anuncia\Managers\EditarPasswordManager;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Modificar la contraseña de cuenta de usuario
 *		- Fijar una contraseña si usuario se registró con social login
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

class ModificaPasswordController extends \BaseController
{
	/* Muestra formulario cambio de password */
	public function getCambiarPassword()
	{
		$cuenta = \Auth::user();
		
		// si hay clave se registró mediante correo electrónico
		if (! empty($cuenta->password))
		{
			return \View::make('modulos.datos.cambiarpassword');	
		}
		// se reegistro con social login entonces hay que fijar password, no cambiar
		return \Redirect::route('fijarpassword');
	}

	/* Cambia password de cuenta de usuario */
	public function postCambiarPassword()
	{
		$cuenta = \Auth::user();
		$password = \Input::get('actualpassword');
		
		// compara las credenciales para verificar si coinciden con los almacenados en la BD	
		if (\Auth::validate(['password' => $password, 'correo' => $cuenta->correo ]))
		{
			$manager = new EditarPasswordManager($cuenta, \Input::all());

			if ($manager->save())
			{
				return \Redirect::route('perfil',[$cuenta->usuario->slug ])->with('cambio_password',
																		  'Su contraseña ha 
																		   sido modificada 
																		   correctamente');
			}
			
			return \Redirect::back()->withInput()->withErrors($manager->getErrores());	
		}
		
		return \Redirect::back()->with('password_error', 1);
	}

	/* Muestra formulario fijar password (cuando usuario se registro con social login) */
	public function getFijarPassword()
	{
		return \View::make('modulos.datos.fijarpassword');
	}

	/* Fija un password si usuario se registró con social login*/
	public function postFijarPassword()
	{
		$cuenta = \Auth::user();
		$manager = new EditarPasswordManager($cuenta, \Input::all());

		if ($manager->save())
		{
			return \Redirect::route('perfil',[$cuenta->usuario->slug ])->with('cambio_password',
																	  'Su Contraseña ha sido 
																	   guardada correctamente, 
																	   ahora también puede ingresar
																	   con su correo y contraseña o 
																	   con su red social.');
		}
		
		return \Redirect::back()->withInput()->withErrors($manager->getErrores());	
	}

}