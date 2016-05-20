<?php namespace comunicacionynotificaciones;


use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\NotificacionRepo;
use Anuncia\Repositorios\ConfiguracionRepo;

use Anuncia\Asistentes\Secretario;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Gestionar las Notificaciones
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


class NotificacionController extends \BaseController
{
	protected $notificacionRepo;
	protected $anuncioRepo;
	protected $configuracionRepo;

	public function __construct(NotificacionRepo $notificacionRepo,
								AnuncioRepo $anuncioRepo,
								ConfiguracionRepo $configuracionRepo)
	{
		$this->notificacionRepo=$notificacionRepo;
		$this->anuncioRepo=$anuncioRepo;
		$this->configuracionRepo=$configuracionRepo;
	}

	/* *Muestra todas las notificaciones de un usuario */
	public function mostrarNotificaciones()
	{
		$usuario = \Auth::user()->usuario;

		return \View::make('modulos.comunicacionynotificaciones.misnotificaciones',
							compact('usuario')
				);
	}
	
	/* Ver la notificacion de manera detallada*/
	public function revisarNotificacion($notificacionId)
	{
		try
		{
			\DB::beginTransaction();	


			$notificacion=$this->notificacionRepo->buscar_notificacion($notificacionId);

			if(empty($notificacion))
			{
				return \Redirect::to('ver/notificaciones')->with('estatus_error',
																 'La notificación ya no está disponible');
			}

			if($notificacion->usuario_id == \Auth::id())
			{
				if($this->notificacionRepo->marcarComoRevisada($notificacion->id))
				{
					$numnotificacionesnovistas= $this->notificacionRepo->numeroNotificacionesNoRevisadas(\Auth::id());
					
					$secretario= new Secretario();
					$secretario->actualizarAlertaNotificaciones(\Auth::id(), $numnotificacionesnovistas);

					\DB::commit();

					if(!empty($notificacion->identificativo)){
						$anuncio=$this->anuncioRepo->buscarAnuncioId($notificacion->identificativo);

						if(empty($anuncio)){
							return \Redirect::to('ver/notificaciones')->with('estatus_error',
																			 'El anuncio asociado a esta notificación 
																			  ya no está disponible');
						}

					}

					$anunciosBloqueadosPermitidos =  $this->configuracionRepo->cargarConfiguracionActual()->anunciosbloqueados;

					return \View::make('modulos.comunicacionynotificaciones.notificacion',
										compact('notificacion','anuncio', 'anunciosBloqueadosPermitidos')
							);
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
}
