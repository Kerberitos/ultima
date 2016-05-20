<?php namespace comunicacionynotificaciones;

use Anuncia\Managers\MensajeManager;

use Anuncia\Asistentes\Secretario;

use Anuncia\Repositorios\MensajeRepo;
use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\AnuncioRepo;

use Carbon\Carbon;
use Jenssegers\Date\Date;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Gestionar los Mensajes
 * ----------------------------------------------------
 * Rutas:
 * 		- miradita/app/routes/auth.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class MensajeController extends \BaseController
{
	protected $mensajeRepo;
	protected $usuarioRepo;
	protected $anuncioRepo;

	public function __construct(MensajeRepo $mensajeRepo,
								UsuarioRepo $usuarioRepo,
								AnuncioRepo $anuncioRepo)
	{
		$this->mensajeRepo=$mensajeRepo;
		$this->usuarioRepo=$usuarioRepo;
		$this->anuncioRepo=$anuncioRepo;
	}

	/* Envia mensaje a usuario*/
	public function enviarMensaje()
	{
		$usuario = \Auth::user()->usuario;

		$remitenteId = $usuario->id;
		
		$rol = $usuario->rol_id;


		# rol 1 = rol usuario
		if ($rol == 1)
		{
			# remitenteRol U = rol usuario
			$remitenteRol = 'U';
		}
		# rol 2 administrador | rol 3 es super admin
		else if ($rol == 2 | $rol == 3 )
		{
			# puede obtener valores de A o S
			$remitenteRol = \Input::get('remitente_rol');
		}
		

		$usuarioId = \Input::get('usuario_id');

		$mensaje = $this->mensajeRepo->nuevoMensaje($remitenteId);

		$manager = new MensajeManager($mensaje, \Input::all());
		
		if ($manager->isValid())
		{

			$mensaje->mensaje = \Helper::purificarCadena(\Input::get('mensaje'));

			# obtiene la fecha de creacion del mensaje a responder 
			$mensaje->previodate = \Input::get('previodate');

			$mensaje->remitente_rol = $remitenteRol;
			
			$mensaje->remitente_nombre = $usuario->nombres;

			$secretario = new Secretario();
			
			if ($manager->save())
			{
				$secretario->crearAlertaMensajes($usuarioId);

				return \Redirect::back()->with('status_ok',
										   'Su mensaje ha sido enviado correctamente');
			}

			return \Redirect::back()->with('status_error',
										   'Su mensaje no pudo ser enviado');
			
		}
		return \Redirect::back()->withInput()->withErrors($manager->getErrores())->with('status_error',
																						'Su mensaje no pudo ser 
																						 enviado');
	}

	/* Muestra una lista de los mensajes */
	public function mostrarMensajes()
	{
		$usuarioId = \Auth::user()->usuario->id;
		
		$mensajes = $this->mensajeRepo->buscarMensajes($usuarioId);
		$mensajesnoleidos = $this->mensajeRepo->numeroMensajesNoLeidos($usuarioId);

		return \View::make('modulos.comunicacionynotificaciones.mismensajes', 
							compact('mensajes','mensajesnoleidos')
				);
	}

	/* Ver el mensaje de manera individual*/
	public function revisarMensaje($mensaje_id)
	{
		try
		{
			\DB::beginTransaction();	

			$mensaje = $this->mensajeRepo->buscarMensajeId($mensaje_id);
			$this->notFoundUnLess($mensaje);

			if ($this->perteneceMensaje($mensaje->usuario_id))
			{
				if ($this->mensajeRepo->marcarComoLeido($mensaje_id))
				{
					$remitente = $this->usuarioRepo->buscarUsuario($mensaje->remitente_id);
					
					$mensajesnoleidos = $this->mensajeRepo->numeroMensajesNoLeidos(\Auth::id());
					
					// actualizar las alertas de mensajes utilizando Secretario
					$secretario = new Secretario();
					$secretario->actualizarAlertaMensajes(\Auth::id(), $mensajesnoleidos);

					$anuncio = "";

					# mensaje->anuncio_id indica si el mensaje hace referencia a un anuncio
					# si es diferente de cero hace referencia al anuncio desde el cual salió el mensaje
					if (! empty($mensaje->anuncio_id))
					{
						$anuncio = $this->anuncioRepo->buscarAnuncioId($mensaje->anuncio_id);
					}

					\DB::commit();

					return \View::make('modulos.comunicacionynotificaciones.leermensaje', 
										compact('mensaje','remitente','anuncio'));
				}
			}
			
			return \App::abort(404);
		
		}
		catch(\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}	

	}
	
	/* Elimina mensaje */
	public function eliminarMensaje($mensaje_id)
	{
		try
		{
			\DB::beginTransaction();

			$mensaje = $this->mensajeRepo->buscarMensajeId($mensaje_id);
			$this->notFoundUnLess($mensaje);

			if($this->perteneceMensaje($mensaje->usuario_id))
			{
				if($this->mensajeRepo->eliminarMensaje($mensaje))
				{
					$mensajesnoleidos= $this->mensajeRepo->numeroMensajesNoLeidos(\Auth::id());
					
					$secretario= new Secretario();
					$secretario->actualizarAlertaMensajes(\Auth::id(), $mensajesnoleidos);

					\DB::commit();

					return \Redirect::to('ver/mensajes')->with('estatus_ok',
															   'Tu mensaje ha sido eliminado');
				}
				return \Redirect::to('ver/mensajes')->with('estatus_error',
					 									   'Tu mensaje no ha podido ser eliminado');
			}
			
			return	\App::abort(404);

		}
		catch(\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}		
	}

	/* Verifica si el mensaje pertenece al usuario que solicita alguna acción*/
	public function perteneceMensaje($usuarioDeMensaje)
	{
		$usuarioActual = \Auth::id();
		
		if ($usuarioDeMensaje == $usuarioActual)
		{
			return true;
		}
		return false;
	}
}
