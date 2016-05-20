<?php namespace usuariospermisosseguridad;

//use Anuncia\Entidades\Usuario;

use Anuncia\Managers\CorreoSimpleManager;

use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\CuentaRepo;

use Anuncia\Asistentes\Cartero;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- activar cuenta de usuario con estado desactivado (registrado con correo electrónico)
 *		- solicitar nuevo enlace de activación
 * 
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class ActivacionCuentaController extends \BaseController
{
	protected $usuarioRepo;
	protected $cuentaRepo;

	// Constructor para asignar el repositorio que manipulará la entidad Usuario 
	public function __construct(UsuarioRepo $usuarioRepo,
								CuentaRepo $cuentaRepo)
	{
		$this->usuarioRepo = $usuarioRepo;
		$this->cuentaRepo = $cuentaRepo;
		
	}

	/* Activa cuenta de usuario, mediante token de usuario */
	public function activarCuenta($random)
	{
		$cuenta = $this->cuentaRepo->buscarCuentaRandom($random);

		// si existe cuenta que coincida con el token recibido, se actualiza el estado de la cuenta a activado
		if (! empty($cuenta))
		{
			# estado_id 1 = activado
			$cuenta->update(array('estado_id' => 1));
		
			return \Redirect::to('ingreso')->with('cuentaactiva_mensaje',1);
		}
		
		return \Redirect::to('ingreso')->with('cuentanoactivada_mensaje',1);
	}



	/* Muestra formulario para solicitar nuevo enlace de activación de cuenta */
	public function getNuevoEnlace()
	{
		return \View::make('modulos.usuariospermisosseguridad.nuevoenlace');
	}

	/* Genera nuevo enlace de activación de cuenta de usuario */
	public function postNuevoEnlace()
	{
		$correo = \Input::get('correo');
	
		$cuenta = $this->cuentaRepo->buscarCuentaCorreo($correo);

		if (! empty($cuenta))
		{
			try
			{
				$estado = $cuenta->estado->estado;
				
				// Comprobar si usuario está desactivado
				if ($estado == 'desactivado')
				{
					/* necesita try-catch para indicar inicio de transacciones*/
					\DB::beginTransaction();

					$manager = new CorreoSimpleManager($cuenta, \Input::all());

					if ($manager->isValid())
					{
						# uniqid Obtiene un identificador único prefijado basado en la hora actual en microsegundos.
						// random almacena el TOKEN de comprobación
						$cuenta->random = uniqid('activacion_',true);
						$manager->save();

						// usuario asociado a la cuenta
						$usuario = $cuenta->usuario;

						# cartero envía email con nuevo enlace de activación a usuario
						$cartero = new Cartero();
						$cartero->cartaNuevoEnlace($usuario);
						
						/* necesita try-catch para indicar fin de transacciones*/
						\DB::commit();
						
						return \View::make('mensajes.usuarioregistrado',
											compact('usuario')
								);
					}

					return \Redirect::back()->withInput()->withErrors($manager->getErrores());
				}

				return \Redirect::back()->with('cuentaestadonodesactivada_info', $estado);	
			}
			catch(\Exception $ex)
			{
				/* necesita try-catch para deshacer todas transacciones en caso de errores*/
				\DB::rollback();
				\Session::flash('error_de_registro_servidor',1);
					
				return \Redirect::back();
			}

		}
		// Si NO existe usuario
		return \Redirect::back()->with('noexisteusuario_error', 1);
	}

	/* Activa cuenta de usuario mediante id de usuario y el token de comprobación (random) */
	public function getActivarNuevoEnlace($id, $random)
	{
		$cuenta = $this->cuentaRepo->buscarCuentaRandomId($id, $random);
		
		if (! empty($cuenta))
		{
			$cuenta->update(array('estado_id'=>1));
			
			/* genera nuevo token después de activar cuenta de usuario */
			$cuenta->random = uniqid('mir_',true);
			$cuenta->save();

			return \Redirect::to('ingreso')->with('cuentaactiva_mensaje',1);
		}
		
		return \Redirect::to('ingreso')->with('cuentanoactivada_mensaje',1);	
	}
}