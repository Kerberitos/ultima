<?php namespace datos;

use Anuncia\Asistentes\Mensajero;
use Anuncia\Repositorios\CuentaRepo;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Controlar la autenticación (Ingreso-inicio de sesión) de usuarios en la aplicación
 * ----------------------------------------------------
 * Rutas:
 *
 *		Rutas cuando el usuario no ha iniciado sesión
 * 		- miradita/app/routes/guest.php
 *
 *		Rutas cuando el usuario ha iniciado sesión 	 		
 *		- miradita/app/routes/auth.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class AutenticacionController extends \BaseController
{
	# objeto que hara consultas a la entidad Usuario
	protected $cuentaRepo;
	
	/* Constructor para asignar el repositorio que manipulará la entidad Usuario */
	public function __construct(CuentaRepo $cuentaRepo)
	{
		$this->cuentaRepo = $cuentaRepo;
	}

	/* Muestra formulario de ingreso */
	public function getIngreso()
	{
		return \View::make('modulos.datos.ingreso');
	}
	
	/* Ingreso al sistema despuès de validar credenciales */
	public function postIngreso()
	{
		# \Input::only retorna array
		# \Input::get retorn cadena

		$correo = \Input::only('correo');
		
		$cuenta = $this->cuentaRepo->buscarCuentaCorreo($correo);

		/* SI cuenta existe en la BD*/
		# si cuenta no está vacia entonces hay cuenta de usuario en la aplicación
		if (! empty($cuenta))
		{
			// estado del usuario
			$estado = $cuenta->estado->estado;

			// Si estado de cuenta es activado sigue el proceso normal de ingreso
			if ($estado == 'activado')
			{
				# credenciales para comparar con la BD
				$data = \Input::only('correo', 'password');
				
				# attempt método de Laravel que recibe credenciales de usuario 
				# constata si coinciden con los datos en la base de datos
				if (\Auth::attempt($data))
				{
					$cuenta = \Auth::user();
					$estado = $cuenta->estado->estado;
							
					# check método de Laravel comprueba si usuario está logeado
					# Utiliza variable de sesión creada si pasa Auth::attempt

					if (\Auth::check() and $cuenta->estado->estado == 'activado')
					{
						return \Redirect::to('/')->with('login_correcto', 1);
					}
				}
				
				return \Redirect::back()->with('login_error', 1);
			}
			
			# si la cuenta posee estado diferente de activado				
			// Si usuario está desactivado, bloqueado o eliminado

			# los posibles valores para accion pueden ser: 'ingresar', 'registrar', 'conectar'
			# 'ingresar' cuando el usuario desea ingresar a la aplicación

			$accion = 'ingresar';
			
			$mensaje = $this->obtenerMensaje($accion, $estado);
			
			// Muestra mensaje de estado de cuenta
			return \View::make('mensajes.mensajeestadocuenta', compact('mensaje', 'correo'));		
		}
		
		return \Redirect::back()->with('no_existe_usuario_error', 1);
	}

	/* Cierra sesión de usuario */
	public function salir() 
	{
		# Cerrar sesión de usuario
		\Auth::logout();
		
		// Vuelve al formulario de inicio y muestra un mensaje indicando que se cerró la sesión
		return \Redirect::to('ingreso')->with('sesion_cerrada_ok', 1);
	}

	/* Obtiene mensajes para informar si usuario está desactivado, bloqueado o eliminado*/
	public function obtenerMensaje($accion, $estado){
		
		$peticion = array(
							'estado' => $estado,
							'accion' => $accion
					);

		$mensajero = new Mensajero($peticion);
		
		$mensaje = $mensajero->getMensaje();
		
		return $mensaje;
	}

}