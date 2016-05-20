<?php namespace administracion;

use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\CuentaRepo;

use Anuncia\Repositorios\ConfiguracionRepo;

use Anuncia\Asistentes\Cartero;
/**
 * ----------------------------------------------------
 * Clase que permite a un Administrador: 
 * 		- Manipular usuarios bloqueados y desactivados
 * ----------------------------------------------------
 * Rutas:
 * 		- miradita/app/routes/admin.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class AdminUsuariosController extends \BaseController 
{
	protected $usuarioRepo;
	protected $cuentaRepo;
	protected $configuracionRepo;

	public function __construct (UsuarioRepo $usuarioRepo,
								CuentaRepo $cuentaRepo,
								 ConfiguracionRepo $configuracionRepo)
	{
		$this->usuarioRepo = $usuarioRepo;
		$this->cuentaRepo = $cuentaRepo;
		$this->configuracionRepo=$configuracionRepo;
	}

	/* Muestra una lista de usuarios bloqueados*/
	public function mostrarUsuariosBloqueados()
	{
		$busqueda = trim(\Input::get('busqueda'));
		$textobuscado = "";
		
		#estado 3 = estado bloqueado
		$estado = 3;

		if ($busqueda == "")
		{
			// si el input de busqueda está vacio no es necesario realizar acciones 
		}
		else if ($busqueda != "")
		{
			$textobuscado = $busqueda;
			//$usuarios = $this->usuarioRepo->busquedaUsuariosPorNombre($busqueda, $estado);
			
			$cuentas = $this->cuentaRepo->busquedaCuentasPorCorreoEstado($busqueda, $estado);

			# sizeof devuelve el tamaño del argumento recibido
			if (sizeof($cuentas) == 0)
			{
				return \Redirect::route('admin.usuarios.bloqueados')->with('status_nohaycoincidencias',
																		   'No hay resultados de búsqueda
																			para '.$textobuscado);
			}
			
			return \View::make('modulos.administracion.listausuariosbloqueados', 
								compact('cuentas','textobuscado')
					);
		}

		$cuentas = $this->cuentaRepo->cuentasBloqueadas();

		return \View::make('modulos.administracion.listausuariosbloqueados', 
							compact('cuentas','textobuscado')
				);
	}
	
	/* Permite ver el usuario bloqueado de manera individual*/
	public  function verUsuarioBloqueado($id)
	{
		$usuario = $this->usuarioRepo->buscarUsuario($id);
		$this->notFoundUnLess($usuario);
		
		# solo usuarios bloqueados
		if ($usuario->cuenta->estado->estado == "bloqueado")
		{
			$configuracion =  $this->configuracionRepo->cargarConfiguracionActual();

			return \View::make('modulos.administracion.verusuariobloqueado', 
								compact('usuario', 'configuracion')
					);	
		}
		
		return \App::abort(404);
	}

	/* Muestra una lista de usuarios desactivados */
	
	
	public function mostrarUsuariosDesactivados()
	{
		$busqueda = trim(\Input::get('busqueda'));
		$textobuscado = "";
		
		# estado 2 = estado desactivado
		$estado = 2;

		if ($busqueda == "")
		{
			// si el input de busqueda está vacio no es necesario realizar acciones 
		}
		else if ($busqueda != "")
		{
			$textobuscado = $busqueda;

			$cuentas = $this->cuentaRepo->busquedaCuentasPorCorreoEstado($busqueda, $estado);
			
			# sizeof devuelve el tamaño del argumento recibido
			if (sizeof($cuentas) == 0)
			{
				return \Redirect::route('admin.usuarios.desactivados')->with('status_nohaycoincidencias', 
																			 'No hay resultados de búsqueda 
																			 para '.$textobuscado);
			}
			return \View::make('modulos.administracion.listausuariosdesactivados', 
							   compact('cuentas','textobuscado')
					);
		}

		$cuentas = $this->cuentaRepo->cuentasDesactivadas();
		
		return \View::make('modulos.administracion.listausuariosdesactivados', 
							compact('cuentas','textobuscado')
				);
	}

	

	/* Permite ver el usuario desactivado de manera individual*/
	public function verUsuarioDesactivado($id)
	{
		$usuario = $this->usuarioRepo->buscarUsuario($id);
		$this->notFoundUnLess($usuario);

		# solo usuarios desactivados
		if ($usuario->cuenta->estado->estado == "desactivado")
		{
			$configuracion =  $this->configuracionRepo->cargarConfiguracionActual();

			return \View::make('modulos.administracion.verusuariodesactivado', 
								compact('usuario','configuracion')
					);	
		}
		
		return \App::abort(404);
	}


	/* Envia respuesta a usuario que escribió desde contactanos */
	public function enviarCorreoAutomatizado($usuarioId)
	{

		
		try
		{
			\DB::beginTransaction();

			$usuario = $this->usuarioRepo->buscarUsuario($usuarioId);
			$this->notFoundUnLess($usuario);

			$estadocuenta = $usuario->cuenta->estado->estado;
			$motivo = '';
			$vista='';
			# cartero enviara el correo electrónico
			$cartero = new Cartero();
			
			# se requiere la configuracion del sistema para realizar comparaciones
			$configuracion = $this->configuracionRepo->cargarConfiguracionActual();
			
			if ($estadocuenta == "bloqueado")
			{
				$vista = 'admin.usuarios.bloqueados';
				if ($usuario->historial)
				{
					$contadorDeDenunciasUsuario = $usuario->historial->denunciasfalsas - $usuario->historial->denunciasverdaderas;
					$anunciosBloqueadosUsuario = $usuario->historial->anunciosbloqueados;
					$comentariosEliminadosUsuario = $usuario->historial->comentarioseliminados;

					if ( $anunciosBloqueadosUsuario >= $configuracion->anunciosbloqueados )
					{
	                	$respuesta = $usuario->nombres.' su cuenta de usuario en Miradita Loja se encuentra bloqueada, 
	                								debido a que superó el número de anuncios bloqueados permitidos	                								anuncios bloqueados.';

	                }
	                else if ($contadorDeDenunciasUsuario >=	$configuracion->contadordedenuncias)
	                {
	                	$respuesta = $usuario->nombres.' su cuenta de usuario en Miradita Loja se encuentra bloqueada, 
	                									 debido a que abusó del sistema de denuncias, realizando denuncias
	                									 falsas repetida e innecesariamente.';
	                
	                }
	                else if ($comentariosEliminadosUsuario >= $configuracion->comentarioseliminados)
	                {
	               		$respuesta = $usuario->nombres.' su cuenta de usuario en Miradita Loja se encuentra bloqueada, 
	               										 debido a que superó el número de comentarios bloqueados permitidos';
	               	}
				}
			}
			else if ($estadocuenta == "desactivado")
			{
				$vista = 'admin.usuarios.desactivados';
				$respuesta = $usuario->nombres.' su cuenta de usuario en Miradita Loja se encuentra desactivada, en el 
												 momento que se registró un enlace de activación fue enviado a su correo
												 electrónico, por favor, si no encuentra el mensaje en su bandeja de entrada
												 revise en spam, o puede solicitar un nuevo enlace de activación.';
			}
			
			/* Envía un correo electrónico con la respuesta */
			if($cartero->cartaRespuestaContactanos($usuario, $respuesta, $estadocuenta))
			{
				
							
				\DB::commit();



				return \Redirect::route($vista)->with('status_ok', 
														'Correo electrónico enviado correctamente'); 
			}

			return \Redirect::route($vista)->with('status_error',
													'El correo electrónico no fue enviado.');
		}
		catch(\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}	
	}





	/* Activa cuenta de usuario si posee estado de desactivado*/
	public function activarCuentaDesactivada($id)
	{
		$usuario = $this->usuarioRepo->buscarUsuario($id);
		$this->notFoundUnLess($usuario);

		// activar solo si la cuenta tiene el estado de desactivado
		if ($usuario->estado->estado == "desactivado")
		{
			$this->usuarioRepo->activarUsuario($usuario->id);

			return \Redirect::route('admin.usuarios.desactivados')->with('status_ok', 
																		'La cuenta del usuario fue activada correctamente'); 
		}
		
		return	\App::abort(404);
	}
}
