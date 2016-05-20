<?php namespace datos;

use Anuncia\Managers\BajaCuentaManager;
use Anuncia\Managers\ModificarCuentaManager;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Eliminar (dar de baja) cuenta de usuario
 *
 *  	NOTA IMPORTANTE: Los usuarios no se eliminan nunca, solo su estado es modificado a eliminado
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

class EliminaCuentaController extends \BaseController
{
	/* Muestra formulario para dar de baja (eliminar) cuenta de usuario */
	public function getBajarCuenta($slug)
	{
		$cuenta = \Auth::user();
		
		// Verifica si la cuenta posee password
		if (!empty($cuenta->password))
		{
			return \View::make('modulos.datos.bajacuenta', 
								compact('cuenta')
					);
		}

		// esta registrado con redes sociales y nunca asignó un password
		return \View::make('modulos.datos.bajacuentasocial', 
							compact('cuenta')
				);
	} 

	/* Procesa la eliminación (dar de baja) cuenta de usuario, registrada mediante correo electrónico*/
	public function postBajarCuenta($slug)
	{
		$cuenta = \Auth::user();
		$correo = $cuenta->correo;
		$password = \Input::get('password');

		$data = [	
					'password' => $password, 
					'correo' => $correo 
				];

		/* Valida las credenciales ingresadas con las del usuario logeado */
		if (\Auth::validate($data))
		{
			$manager = new BajaCuentaManager($cuenta, \Input::all());
			
			# asigna estado 4 = eliminado
			$cuenta->estado_id = 4;

			if ($manager->save())
			{
				\Auth::logout();
				
				return \View::make('mensajes.mensajebajacuenta', 
									compact('cuenta')
						);
			}
			// no pasó las validaciones
			return \Redirect::back()->withInput()->withErrors($manager->getErrores());
		}
		
		return \Redirect::back()->with('bajacuenta_error', 1);
	}

	/* Procesa la eliminación de cuenta de usuario, cuenta registrada mediante social login */
	public function postBajarCuentaSocial()
	{
		$usuario = \Auth::user();
		$correo = $usuario->correo;
		$correoVista = \Input::get('correo');
		
		// verifica si el correo de usuario logueado y el correo en la vista es igual
		if (\Helper::compararCadenas($correo, $correoVista))
		{
			// Se puede utilizar ModificarCuentaManager, ya que solo 
			// valida un correo y  no importa que sea el mismo 
			
			$manager = new ModificarCuentaManager($usuario, \Input::all());
			
			$usuario->estado_id = 4;
			
			if ($manager->save())
			{		
				\Auth::logout();
				
				return \View::make('mensajes.mensajebajacuenta',
									compact('usuario')
						);
			}
			
			return \Redirect::back()->withInput()->withErrors($manager->getErrores());
		}

		return \Redirect::back()->with('correosdistintos_error', 1);
	}

}