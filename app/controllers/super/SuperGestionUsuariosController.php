<?php namespace super;

use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\PostulanteRepo;
use Anuncia\Repositorios\NotificacionRepo;

use Anuncia\Asistentes\Secretario;


/**
 * ----------------------------------------------------
 * Clase que : 
 * 		- Gestiona acciones sobre usuarios
 *		 
 * ----------------------------------------------------
 * Rutas:
 * 		- miradita/app/routes/super.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class SuperGestionUsuariosController extends \BaseController
{
	protected $usuarioRepo;
	protected $postulanteRepo;
	protected $notificacionRepo;
	
	public function __construct(UsuarioRepo $usuarioRepo,
								PostulanteRepo $postulanteRepo,
								NotificacionRepo $notificacionRepo)
	{
		$this->postulanteRepo = $postulanteRepo;
		$this->usuarioRepo = $usuarioRepo;
		$this->notificacionRepo = $notificacionRepo;
	}

	/* Asciende usuario a administrador */
	public function ascenderAAdministrador($usuarioId)
	{
		try
		{
			\DB::beginTransaction();

			$usuario = $this->usuarioRepo->buscarUsuario($usuarioId);
			$this->notFoundUnLess($usuario);

			if (\Auth::user()->rol_id == 3)
			{
				if ($this->usuarioRepo->ascenderAAdministrador($usuarioId))
				{
					// buscar si usuario se encuentra como postulante a administrador
					$postulante = $this->postulanteRepo->buscarPostulante($usuarioId);

					// si existe se elimina postulante
					if ($postulante)
					{
						$this->postulanteRepo->borrarPostulante($usuarioId);
					}

					// Crear notificacion de usuario promovido a administrador
					$notificacion= $this->notificacionRepo->nuevaNotificacion($usuarioId);
					$this->notificacionRepo->notificacionPromovidoaAdministrador($notificacion);

					// Actualizar alertas de notificaciones de usuario
					$this->actualizarAlertasDeNotificaciones($usuarioId);

					\DB::commit();

					return \Redirect::back()->with('status_ok',
												   'Usuario ascendido a administrador 
												    correctamente');
					
				}
				return \Redirect::back()->with('status_error', 
											   'Hubo problemas al ascender usuario 
											    a administrador');
			}	
			
			return \Redirect::back()->with('status_error', 
											'No cuenta con privilegios para ascender 
											 un usuario a Administrador');
	
		}
		catch(\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}

	}

	/* Rechaza solicitud a postulante de usuario a administrador */
	public function rechazarSolicitudAPostulante($usuarioId)
	{
		try
		{
			\DB::beginTransaction();	

			$postulante = $this->postulanteRepo->buscarPostulante($usuarioId);
			$this->notFoundUnLess($postulante);

			if (\Auth::user()->rol_id == 3)
			{
				if ($this->postulanteRepo->borrarPostulante($usuarioId))
				{
					// Crear notificacion de solicitud a administrador rechazada
					$notificacion= $this->notificacionRepo->nuevaNotificacion($usuarioId);
					$this->notificacionRepo->notificacionRechazadaSolicitud($notificacion);

					// Actualizar alertas de notificaciones de usuario
					$this->actualizarAlertasDeNotificaciones($usuarioId);

					\DB::commit();

					return \Redirect::route('lista.usuarios.postulantes')->with('status_ok', 
																				'La solicitud para 
																				 administrador fue 
																				 rechazada correctamente');
				}
				return \Redirect::route('lista.usuarios.postulantes')->with('status_error', 
																			'La solicitud para administrador 
																			 no pudo ser rechazada');
			}

			return \Redirect::route('lista.usuarios.postulantes')->with('status_error', 
										   								'No cuenta con privilegios para rechazar 
										 								 postulante a administrador');
		
		}
		catch(\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}

	}

	/* Actualiza alerta de cantidad de notificaciones */
	public function actualizarAlertasDeNotificaciones($usuarioId)
	{
		$notificacionesnovistas = $this->notificacionRepo->numeroNotificacionesNoRevisadas($usuarioId);
		$secretario = new Secretario();
		$secretario->actualizarAlertaNotificaciones($usuarioId, $notificacionesnovistas);
	}

	/* Asciende usuario a Super administrador */
	public function ascenderASuperadministrador($usuarioId)
	{
		$usuario = $this->usuarioRepo->buscarUsuario($usuarioId);
		$this->notFoundUnLess($usuario);

		# rol_id 3 = super administrador
		if (\Auth::user()->rol_id == 3)
		{
			if ($this->usuarioRepo->ascenderASuper($usuarioId))
			{
				
				return \Redirect::route('lista.administradores')->with('status_ok', 
																	   'Usuario fue ascendido 
																	    a Super administrador');
			}
			
			return \Redirect::route('lista.administradores')->with('status_error', 
																   'Usuario no pudo ser ascendido 
																    a Super administrador');
		}
			
		return \Redirect::route('lista.administradores')->with('status_error', 
															   'No cuentas con privilegios para ascender 
															    un usuario a Super administrador');
	}

	/* Desciende Super administrador a administrador */
	public  function descenderAAdministrador($usuarioId)
	{
		if (\Auth::user()->rol_id == 3)
		{
			if ($this->usuarioRepo->descenderAAdministrador($usuarioId))
			{
				return \Redirect::back()->with('status_ok', 
											   'Super Administrador descendido a 
											    administrador correctamente');
			}
			
			return \Redirect::back()->with('status_error', 
										   'Super Administrador no pudo ser 
										    descendido a administrador');
		}	
		
		return \Redirect::back()->with('status_error', 
									   'No cuentas con privilegios para descender 
									    Super administrador a administrador');
		
	}

	/* Desciende Administrador o Super administrador a usuario */
	public function descenderAUsuario($usuarioId)
	{
		$usuario = $this->usuarioRepo->buscarUsuario($usuarioId);
		$this->notFoundUnLess($usuario);

		if (\Auth::user()->rol_id == 3)
		{
			if ($this->usuarioRepo->descenderAUsuario($usuarioId))
			{
				return \Redirect::route('lista.administradores')->with('status_ok', 
																	   'Administrador fue descendido 
																	    a Usuario');
			}
			
			return \Redirect::route('lista.administradores')->with('status_error', 
																   'Administrador no pudo ser 
																    descendido a Usuario');
		}
		
		return \Redirect::route('lista.administradores')->with('status_error', 
															   'No cuentas con privilegios para 
															    descender un administrador a usuario');
	}

}