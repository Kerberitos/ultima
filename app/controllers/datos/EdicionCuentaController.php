<?php namespace datos;

use Anuncia\Managers\ModificarCuentaManager;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Editar el correo de la cuenta de usuario
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

class EdicionCuentaController extends \BaseController
{
	/* Muestra formulario edición de cuenta */
	public function getEdicionCuenta($slug)
	{
		$cuenta = \Auth::user();
		
		// Verificar si la cuenta se ha registrado con redes  sociales
		// usuario no puede modificar correo por estar asociado a una red social
		
		if($cuenta->bandera_social)
		{
			return \View::make('modulos.datos.editarcuentasocial', 
								compact('cuenta')
					);
		}
		
		return \View::make('modulos.datos.editarcuenta',
						    compact('cuenta')
				);
	}
	
	/* Procesa formulario editar cuenta de usuario */
	public function postEdicionCuenta($slug)
	{
		$cuenta = \Auth::user();
		
		$correoNuevo = \Input::only('correo');
		
		# actualcorreo es un input tipo hidden enviado desde el formulario editar cuenta
		$correo = \Input::get('actualcorreo');

		$password = \Input::get('password');

		// verificar la cuenta ingresada, constatando sus credenciales
		if (\Auth::validate(['correo' => $correo, 'password' => $password]))
		{
			$manager = new ModificarCuentaManager($cuenta, \Input::all());
			
			if ($manager->save())
			{
				return \Redirect::route('perfil',[$cuenta->usuario->slug ])->with('cambio_correcto', 
																		  'Su correo ha sido 
																		   modificado correctamente');
			}

			return \Redirect::back()->withInput()->withErrors($manager->getErrores());
		}
		
		return \Redirect::back()->with('password_error', 1);
	}
	
}

