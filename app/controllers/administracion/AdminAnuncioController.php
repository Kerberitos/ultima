<?php namespace administracion;

use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\HistorialRepo;
use Anuncia\Repositorios\HistorialanuncioRepo;
use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\CuentaRepo;
use Anuncia\Repositorios\NotificacionRepo;
use Anuncia\Repositorios\ConfiguracionRepo;

use Anuncia\Managers\HistorialanuncioManager;

use Anuncia\Asistentes\Secretario;

/**
 * ----------------------------------------------------
 * Clase que permite a un Administrador: 
 * 		- Revisar anuncios que desean ser publicados
 * 		- Gestionar (activar, rechazar o bloquear) anuncios
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

class AdminAnuncioController extends \BaseController
{
	protected $anuncioRepo;
	protected $configuracionRepo;
	protected $historialRepo;
	protected $historialanuncioRepo;
	protected $notificacionRepo;
	protected $usuarioRepo;
	protected $cuentaRepo;

	public function __construct(AnuncioRepo $anuncioRepo,
								ConfiguracionRepo $configuracionRepo,
								HistorialRepo $historialRepo,
								HistorialanuncioRepo $historialanuncioRepo,
								UsuarioRepo $usuarioRepo,
								CuentaRepo $cuentaRepo,
								NotificacionRepo $notificacionRepo)
	{
		$this->anuncioRepo = $anuncioRepo;
		$this->configuracionRepo = $configuracionRepo;
		$this->historialRepo = $historialRepo;
		$this->historialanuncioRepo = $historialanuncioRepo;
		$this->usuarioRepo = $usuarioRepo;
		$this->cuentaRepo = $cuentaRepo;
		$this->notificacionRepo = $notificacionRepo;
	}

	/* Muestra los anuncios que solicitaron publicación*/
	public function solicitanPublicacion()
	{
		$anuncios = $this->anuncioRepo->buscarAnunciosPorPublicar();

		return \View::make('modulos.administracion.listasolicitanpublicacion',
							compact('anuncios')
				);
	}

	/* Muestra los anuncios bloqueados */
	public function mostrarAnunciosBloqueados()
	{
		
		$anuncios = $this->anuncioRepo->buscarAnunciosBloqueados();

		
		
		$administradores = $this->usuarioRepo->buscarAdministradoresBloqueadores($anuncios);
		

		return \View::make('modulos.administracion.anunciosbloqueados',
							compact('anuncios', 'administradores')
				);
	}


	/* Muestra detalle del anuncio bloqueado*/
	public function revisarAnuncioBloqueado($seccionanuncio, $idanuncio)
	{
		$anuncio = $this->anuncioRepo->buscarAnuncioId($idanuncio);
		$this->notFoundUnLess($anuncio);

		$ultimaHistoria = $this->historialanuncioRepo->cargarUltimaHistoria($idanuncio);

		$administrador = $this->usuarioRepo->buscarUsuario($anuncio->admin);

		return \View::make('modulos.administracion.revisionindividual',
							compact('anuncio', 'administrador','ultimaHistoria')
				);

	}

	/* Muestra historial de anuncio bloqueado */
	public function mostrarHistorialAnuncio($idanuncio)
	{
		
		$historialAnuncio = $this->historialanuncioRepo->cargarHistorialAnuncio($idanuncio);

		return \View::make('modulos.administracion.verhistorialanuncio',
							compact('historialAnuncio')
				);
	}



	/* Muestra el anuncio para que sea revisado */
	public function getRevisarAnuncio($seccionanuncio, $idanuncio)
	{
		$anuncio = $this->anuncioRepo->buscarAnuncioId($idanuncio);
		$this->notFoundUnLess($anuncio);

		# admin es requerido si el anuncio ya está siendo revisado por un administrador
		$admin = \Auth::id();
		
		// Solo anuncios que solicitaron publicación pueden ser revisados
		# anuncio con estado_id de 5 = anuncio con estado de revision  
		if (\Helper::compararCadenas($anuncio->estatus_revision, "libre") & ($anuncio->estado_id == 5))
		{
			$this->anuncioRepo->estatusRevisionOcupado($anuncio, $admin);

			return \View::make('modulos.administracion.revisionindividual', 
								compact('anuncio')
					); 
		}
		else if (\Helper::compararCadenas($anuncio->estatus_revision, "ocupado") & ($anuncio->admin == $admin))
		{
			return \View::make('modulos.administracion.revisionindividual', 
								compact('anuncio')
					); 
		}
		else if (\Helper::compararCadenas($anuncio->estatus_revision, "ocupado") & ($anuncio->admin != $admin))
		{
			return \Redirect::route('admin.publicar')->with('status_error', 
															'Este anuncio lo está revisando otro administrador.');
		}
		else
		{
			return \Redirect::route('admin.publicar')->with('status_error', 
															'Ese anuncio no ha solicitado revision.');
		}
	}

	/* Permite activar un anuncio y sea publicado de esta manera*/
	# estado_id 1 = estado activado
	public function activarAnuncio($anuncioId)
	{
		try
		{
			\DB::beginTransaction();	

			$anuncio = $this->anuncioRepo->buscarAnuncioId($anuncioId);
			$this->notFoundUnLess($anuncio);

			
			if ($anuncio->admin == \Auth::id())
			{
				//Si anuncio solicitó revisión puede ser activado
				# estado 5 = revision
				if($anuncio->estado_id == 5)
				{
					if ($this->anuncioRepo->activarAnuncio($anuncioId))
					{
						/*Crear notificacion de anuncio publicado*/
						$notificacion = $this->notificacionRepo->nuevaNotificacion($anuncio->usuario_id);
						$this->notificacionRepo->notificacionAnuncioPublicado($notificacion, $anuncio);

						

						/* actualizar historial de anuncio*/
						$atributos = [
										
									'accion'=>'publicado',
									'justificacion'=>'Sin inconvenientes'
					 			];
						
						# se envía: id del anuncio, id de política, los atributos a guardar
						$this->actualizarHistorialAnuncio($anuncioId, 0, $atributos );


						/*Actualizar alertas para usuario*/
						$notificacionesnovistas = $this->notificacionRepo->numeroNotificacionesNoRevisadas($anuncio->usuario_id);
						$secretario = new Secretario();
						$secretario->actualizarAlertaNotificaciones($anuncio->usuario_id, $notificacionesnovistas);

						\DB::commit();


						return \View::make('modulos.administracion.publicarfacebook', 
											compact('anuncio')
								); 
					}
					return \Redirect::route('admin.publicar')->with('status_error', 
																'No se pudo activar el anuncio');
				}
				return \Redirect::route('admin.publicar')->with('status_error', 
																'El anuncio no solicitó publicación');
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

	public function actualizarHistorialAnuncio($anuncioId, $politicaId,  $atributos)
	{
		$historialAnuncio = $this->historialanuncioRepo->nuevoHistorialAnuncio($anuncioId);

		$historialAnuncio->usuario_id = \Auth::id();
		$historialAnuncio->politica_id = $politicaId;

		$managerhistorial = new HistorialanuncioManager($historialAnuncio, $atributos);	 	
		$managerhistorial->save();
	}
	
	/* Permite rechazar la publicación un anuncio */
	# estado_id 7 = estado rechazado
	public function rechazarAnuncio()
	{
		
		//dd(\Input::all());
		try
		{
			\DB::beginTransaction();	


			$anuncioId = \Input::get('anuncio_id');

			$anuncio = $this->anuncioRepo->buscarAnuncioId($anuncioId);
			$this->notFoundUnLess($anuncio);
			
			

			if ($anuncio->admin == \Auth::id())
			{
				if($this->anuncioRepo->rechazarAnuncio($anuncioId))
				{
					/*Crear notificacion de anuncio rechazado*/
					$notificacion = $this->notificacionRepo->nuevaNotificacion($anuncio->usuario_id);
					$this->notificacionRepo->notificacionAnuncioRechazado($notificacion, $anuncio);


						/* actualizar historial de anuncio */
						# se envía: id del anuncio, id de política, los atributos a guardar
						$this->actualizarHistorialAnuncio($anuncioId, \Input::get('politica_id'), \Input::all());


					/*Actualizar alertas para usuario*/
					$notificacionesnovistas = $this->notificacionRepo->numeroNotificacionesNoRevisadas($anuncio->usuario_id);
					$secretario = new Secretario();
					$secretario->actualizarAlertaNotificaciones($anuncio->usuario_id, $notificacionesnovistas);
					

					\DB::commit();


					return \Redirect::route('admin.publicar')->with('status_ok', 
																	'El anuncio fue rechazado correctamente');
				}
					
				return \Redirect::route('admin.publicar')->with('status_error', 
																'Error al momento de rechazar el anuncio. Volver a revisar');
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

	/* Permite bloquear un anuncio */
	# estado_id 3 = estado bloqueado
	public function bloquearAnuncio()
	{
		
		try
		{
			\DB::beginTransaction();

			$anuncioId = \Input::get('anuncio_id');

			$anuncio = $this->anuncioRepo->buscarAnuncioId($anuncioId);
			$this->notFoundUnLess($anuncio);


			

			// Solo se pueden bloquear anuncios activos o denunciados
			# estado_id 1 = activado y estado_id 6 = denunciado
			if ( $anuncio->estado_id == 1 | $anuncio->estado_id == 6 )
			{
				if ($this->anuncioRepo->bloquearAnuncio($anuncioId, \Auth::id()))
				{
					$admin = array('nombres'=>\Auth::user()->usuario->nombres);

					/* Actualiza el historial del usuario dueño del anuncio */
					$historialDenunciado = $this->historialRepo->nuevoHistorial($anuncio->usuario_id);
					$historialDenunciado->anunciosbloqueados++;
					$this->historialRepo->save($historialDenunciado);


						/* actualizar historial de anuncio */
						# se envía: id del anuncio, id de política, los atributos a guardar
						$this->actualizarHistorialAnuncio($anuncioId, \Input::get('politica_id'), \Input::all());


					/* Crea notificacion de anuncio bloqueado */
					$notificacion = $this->notificacionRepo->nuevaNotificacion($anuncio->usuario_id);
					$this->notificacionRepo->notificacionAnuncioBloqueado($notificacion, $anuncio);

					/* Actualiza alertas para usuario */
					$notificacionesnovistas = $this->notificacionRepo->numeroNotificacionesNoRevisadas($anuncio->usuario_id);
					$secretario = new Secretario();
					$secretario->actualizarAlertaNotificaciones($anuncio->usuario_id, $notificacionesnovistas);

					/* Configuración del sistema para conocer los anuncios bloqueados permitidos*/
					$configuracion = $this->configuracionRepo->cargarConfiguracionActual();
					$anunciosBloqueadosPermitidos = $configuracion->anunciosbloqueados;

					// Si el usuario llega al limite de anuncios bloqueados permitidos se bloquea la cuenta de usuario
					# estado_id 3 = bloqueado
					if ($historialDenunciado->anunciosbloqueados >= $anunciosBloqueadosPermitidos)
					{
						$this->cuentaRepo->bloquearCuenta($historialDenunciado->usuario_id);
					}

					\DB::commit();


					return \View::make('mensajes.bloqueadocorrectamente', 
										compact('admin')
							);	
				}
				return \Redirect::back()->with('error_bloqueado',
											   'Hubo un error, el anuncio no pudo ser bloqueado');
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



	/* Permite desbloquear un anuncio, estableciéndolo como desactivado */
	# estado_id 2 = estado desactivado (creado)
	public function desbloquearAnuncio()
	{
		try
		{
			\DB::beginTransaction();

			$anuncioId = \Input::get('anuncio_id');

			$anuncio = $this->anuncioRepo->buscarAnuncioId($anuncioId);
			$this->notFoundUnLess($anuncio);

		
			

			// Solo se pueden desbloquear anuncios bloqueados
			# estado_id 3 = bloqueado
			if ( $anuncio->estado_id == 3 )
			{
				if ($this->anuncioRepo->desbloquearAnuncio($anuncioId, \Auth::id()))
				{
					

					/* Actualiza el historial del usuario dueño del anuncio */
					$historialDenunciado = $this->historialRepo->nuevoHistorial($anuncio->usuario_id);
					$historialDenunciado->anunciosbloqueados--;
					$this->historialRepo->save($historialDenunciado);


						/* actualizar historial de anuncio */
						# se envía: id del anuncio, id de política, los atributos a guardar
						$this->actualizarHistorialAnuncio($anuncioId, 0, \Input::all());

				
					

					// Si el usuario está bloqueado se lo activa
					# estado_id 1 = activado

					if ($anuncio->usuario->cuenta->estado->estado == 'bloqueado')
					{
						$this->cuentaRepo->desbloquearCuenta($historialDenunciado->usuario_id);
					}

					\DB::commit();


					return \Redirect::route('admin.anuncios.bloqueados')->with('status_ok', 
																		'El anuncio fue desbloqueado correctamente');

							
				}
				return \Redirect::back()->with('error_bloqueado',
											   'Hubo un error, el anuncio no pudo ser bloqueado');
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

	/* Muestra los anuncios que solicitaron publicación pero están aún siendo revisados */
	public function solicitanPublicacionPendientes()
	{
		$anuncios = $this->anuncioRepo->buscarAnunciosPorPublicarPendientes(\Auth::id());

		return \View::make('modulos.administracion.listasolicitantespendientes',
							compact('anuncios')
				);
	}

}
