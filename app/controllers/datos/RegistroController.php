<?php namespace datos;

use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\CuentaRepo;

use Anuncia\Managers\UsuarioManager;
use Anuncia\Managers\CuentaManager;

use Anuncia\Asistentes\Mensajero;
use Anuncia\Asistentes\Cartero;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Dar de alta usuarios (Registro de usuarios) en la aplicación
 * ----------------------------------------------------
 * Rutas:
 *
 *		Rutas cuando el usuario no ha iniciado sesión
 * 		- miradita/app/routes/guest.php
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class RegistroController extends \BaseController {
	
	# objeto que hara consultas a la entidad Usuario
	protected $usuarioRepo;
	protected $cuentaRepo;

	/* Constructor para asignar el repositorio que manipulará la entidad Usuario */
	public function __construct(UsuarioRepo $usuarioRepo,
								CuentaRepo $cuentaRepo)
	{
		$this->usuarioRepo = $usuarioRepo;
		$this->cuentaRepo = $cuentaRepo;
	}

	/* Muestra formulario de registro */
	public function getRegistro()
	{
		return \View::make('modulos.datos.registro');
	}
	
	/* Resgistra (da de alta) usuario en la aplicación */
	public function postRegistro()
	{
		# \Input::only retorna array
		# \Input::get retorn cadena

		$correo = \Input::only('correo');
		$cuenta = $this->cuentaRepo->buscarCuentaCorreo($correo['correo']);

		# los posibles valores para accion pueden ser: 'ingresar', 'registrar', 'conectar'
		# 'registrar' cuando el usuario desea registrarse en la aplicación

		$accion = 'registrar';

		/* Si usuario NO existe en la BD se crea usuario y su cuenta de usuario*/
		# usuario está vacio
		if (empty($cuenta))
		{
			try
			{
				$nombres = trim(\Input::get('nombres'));

				$data = [
				
						'nombres' => $nombres,
				];
				
				$usuario = $this->usuarioRepo->nuevoUsuario($data);
				$cuenta = $this->cuentaRepo->nuevaCuenta($accion);

				$datosUsuario = [

								'nombres' => $nombres,
								'genero' => \Input::get('genero'),
								'politicas' => \Input::get('politicas')

				];

				$datosCuenta = [
					
								'correo' => trim(\Input::get('correo')),
								'password' => \Input::get('password'),
								'password_confirmation' => \Input::get('password_confirmation')

				];

				$managerUsuario = new UsuarioManager($usuario, $datosUsuario);
				$managerCuenta = new CuentaManager($cuenta, $datosCuenta);

				if ($managerUsuario->isValid())
				{
					if ($managerCuenta->isValid())
					{
						# cartero envia correo
						$cartero = new Cartero();
							
						/* necesita try-catch para indicar inicio de transacciones*/
						\DB::beginTransaction();

						if ($managerUsuario->save())
						{
							/* vincula usuario con su cuenta */	
							$cuenta->usuario_id = $usuario->id;
							$managerCuenta->save();

							//dd($usuario->cuenta->correo);
							$cartero->cartaRegistro($usuario);

							/* necesita try-catch para indicar fin de transacciones*/
							\DB::commit();
								
							return \View::make('mensajes.usuarioregistrado', compact('usuario'));
						}
					}
					return \Redirect::back()->withInput()->withErrors($managerCuenta->getErrores());	
				}
				return \Redirect::back()->withInput()->withErrors($managerUsuario->getErrores());
			}
			catch(\Exception $ex)
			{
				/* necesita try-catch para deshacer todas transacciones en caso de errores*/
				\DB::rollback();
				\Session::flash('error_de_registro_servidor',1);
					
				return \Redirect::back();
			}	
		}

		// estado de la cuenta de usuario
		$estado = $cuenta->estado->estado;

		if ($estado == 'activado')
		{
			return \Redirect::back()->with('status_error', 
										   'El correo que desea utilizar ya se encuentra registrado en Miradita');
		}
		
		// Si usuario está desactivado, bloqueado o eliminado

	
		$mensaje= $this->obtenerMensaje($accion, $estado);
		
		// Muestra mensaje de estado de cuenta
		return \View::make('mensajes.mensajeestadocuenta', compact('mensaje', 'correo'));	
	}

	/* Obtiene mensaje para informar si usuario está desactivado, bloqueado o eliminado */
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