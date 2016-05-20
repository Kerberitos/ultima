<?php
use Anuncia\Repositorios\ComentarioRepo;
use Anuncia\Repositorios\RespuestaRepo;
use Anuncia\Repositorios\NotificacionRepo;
use Anuncia\Repositorios\AnuncioRepo;

use Anuncia\Managers\ComentarioManager;
use Anuncia\Managers\RespuestaManager;

use Anuncia\Asistentes\Secretario;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Crear y borrar comentarios en los anuncios
 *		- Crear y borrar respuestas de los comentarios
 * 
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class ComentarioController extends BaseController
{
	protected $comentarioRepo;
	protected $respuestaRepo;
	protected $notificacionRepo;
	protected $anuncioRepo;

	public function __construct(ComentarioRepo $comentarioRepo,
								RespuestaRepo $respuestaRepo,
								NotificacionRepo $notificacionRepo,
								AnuncioRepo $anuncioRepo)
	{

		$this->comentarioRepo = $comentarioRepo;
		$this->respuestaRepo = $respuestaRepo;
		$this->notificacionRepo = $notificacionRepo;
		$this->anuncioRepo = $anuncioRepo;
	}
	
	/* Crea comentario en un anuncio */
	public function comenta()
	{
		$usuario_id = \Auth::id();
		$comentario = $this->comentarioRepo->nuevoComentario($usuario_id);
		
		if (\Auth::user()->foto == "")
		{
			if(\Auth::user()->usuario->genero=='male')
			{
				$foto = URL::to('/')."/assets/images/usuario_hombre.png";
			}
			else
			{
				$foto = URL::to('/')."/assets/images/usuario_mujer.png";	
			}
		}
		else
		{
			$foto= URL::to('/').\Auth::user()->usuario->foto;
		}

		$nombres = \Auth::user()->usuario->nombres;

		$manager = new ComentarioManager($comentario, \Input::all());

		$anuncio = $this->anuncioRepo->buscarAnuncioId(\Input::get('anuncio_id'));

		if(empty($anuncio))
		{
			return Response::json(
									[
										'success' => false,
										
									]
					);
		}
		// si anuncio no está vacío seguimos con normalidad el proceso
		
		if ($manager->isValid())
		{
			
			try
			{
				\DB::beginTransaction();
					
				$comentariolimpio = \Helper::purificarCadena(\Input::get('comentario'));
				$comentario->comentario = $comentariolimpio;
					
				if ($manager->save())
				{
					$this->notificarComentario($anuncio);
					
					\DB::commit();

					$fecha = $comentario->created_at->format('j/m/Y H:i a');

					return Response::json(
											[
												'success' => true,
												'comentario' => $comentariolimpio,
												'foto' => $foto,
												'nombres' => $nombres,
												'fecha' => $fecha
										  	]
							);
				}
				else
				{
						
				}
			}
			catch(\Exception $ex)
			{
				\DB::rollback();
				\Session::flash('error_de_servidor',1);
				return \Redirect::back();
			}
		}
		else
		{
			if (Request::ajax())
			{
				return Response::json(
										[
											'success' => false,
											'errors' => $manager->getErrores()->toArray()
										]
						);
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($manager->getErrores());
			}
		}
	}

	/* Crea respuesta para un comentario en un anuncio */
	public function respuesta()
	{
		$usuario_id = \Auth::id();
	
		$respuesta = $this->respuestaRepo->newRespuesta($usuario_id);
		
		if (\Auth::user()->foto == "")
		{
			if (\Auth::user()->usuario->genero=='male')
			{
				$foto = URL::to('/')."/assets/images/usuario_hombre.png";
			}
			$foto = URL::to('/')."/assets/images/usuario_mujer.png";
		}
		else
		{
			$foto= URL::to('/').\Auth::user()->usuario->foto;
		}




		$manager = new RespuestaManager($respuesta, \Input::all());

		/*necesario el anuncio para notificaciones*/
		$anuncio = $this->anuncioRepo->buscarAnuncioId(\Input::get('anuncio_id'));


		if (! empty($anuncio))
		{
			// Si el creador del anuncio responde se lo visualiza como Anunciante
			if( $anuncio->usuario_id == \Auth::user()->id)
			{
				$nombres = "Anunciante";
			}
			else
			{
				$nombres = \Auth::user()->usuario->nombres;
			}
		}
		else
		{
			$nombres = \Auth::user()->usuario->nombres;	
		}


		$habiacomentado = \Input::get('usuario_id');

		if (empty($anuncio))
		{
			return Response::json(
									[
										'success' => false,
										
									]
					);
		}


		if ($manager->isValid())
		{

			try
			{
				\DB::beginTransaction();

				$respuestalimpia= \Helper::purificarCadena(\Input::get('respuesta'));
				$respuesta->respuesta=$respuestalimpia;
				if($manager->save()){


					/*Crear notificacion de comentario respondido*/
					if($habiacomentado!=$usuario_id){
						$this->notificarRespuesta($anuncio, $habiacomentado);
					}
					
					if($anuncio->usuario_id != $usuario_id){
						$this->notificarAccion($anuncio);
					}
						
					\DB::commit();


					$fecha=$respuesta->created_at->format('j/m/Y H:i a');
					return Response::json([
						'success'=>true,
						'respuesta'=> $respuestalimpia,
						'foto'=>$foto,
						'nombres'=>$nombres,
						'fecha'=>$fecha
						]);
				}
			}
			catch(\Exception $ex)
			{
				\DB::rollback();
				\Session::flash('error_de_servidor',1);
				return \Redirect::back();
			}

		}
		else
		{
			if(Request::ajax())
			{
				return Response::json([
										'success'=>false,
										'errors'=> $manager->getErrores()->toArray()
									  ]
						);
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($manager->getErrores());
			}
		
		}

	}


	/* Crea notificación de comentario */
	public function notificarComentario($anuncio)
	{
		/* Si existe notificación tipo comntario la carga*/
		$notificacion = $this->notificacionRepo->existeNotificacionComentario($anuncio->usuario->id, $anuncio->id);
		
		// si existe notificación	
		if (! empty($notificacion))
		{
			$this->notificacionRepo->notificacionComentario($notificacion, $anuncio);
		}
		else
		{
			$notificacion = $this->notificacionRepo->nuevaNotificacion($anuncio->usuario->id);
			$this->notificacionRepo->notificacionComentario($notificacion, $anuncio);
		}

		/*Actualizar alertas para usuario*/
		$notificacionesnovistas = $this->notificacionRepo->numeroNotificacionesNoRevisadas($anuncio->usuario_id);
		$secretario = new Secretario();
		$secretario->actualizarAlertaNotificaciones($anuncio->usuario_id, $notificacionesnovistas);
	}

	/* Crea notificación de respuesta */
	public function notificarRespuesta($anuncio, $habiacomentado)
	{
		/* Si existe notificación tipo respuesta la carga*/
		$notificacion = $this->notificacionRepo->existeNotificacionRespuesta($habiacomentado, $anuncio->id);
		
		// si existe notificación	
		if (! empty($notificacion))
		{
			$this->notificacionRepo->notificacionRespuesta($notificacion, $anuncio);
		}
		else
		{
			$notificacion = $this->notificacionRepo->nuevaNotificacion($habiacomentado);
			$this->notificacionRepo->notificacionRespuesta($notificacion, $anuncio);
		}

		/*Actualizar alertas para usuario*/
		$notificacionesnovistas = $this->notificacionRepo->numeroNotificacionesNoRevisadas($habiacomentado);
		$secretario = new Secretario();
		$secretario->actualizarAlertaNotificaciones($habiacomentado, $notificacionesnovistas);
	}

	/* Crea notificación de accion sobre un anuncio */
	public function notificarAccion($anuncio)
	{
		/* Si existe notificación tipo accion la carga*/
		$notificacion = $this->notificacionRepo->existeNotificacionAccion($anuncio->usuario->id, $anuncio->id);

		if (! empty($notificacion))
		{
			$this->notificacionRepo->notificacionAccion($notificacion, $anuncio);
		}
		else
		{
			$notificacion = $this->notificacionRepo->nuevaNotificacion($anuncio->usuario->id);
			$this->notificacionRepo->notificacionAccion($notificacion, $anuncio);
		}
		
		/*Actualizar alertas para usuario*/
		$notificacionesnovistas = $this->notificacionRepo->numeroNotificacionesNoRevisadas($anuncio->usuario_id);
		$secretario = new Secretario();
		$secretario->actualizarAlertaNotificaciones($anuncio->usuario_id, $notificacionesnovistas);
	}

	/* Elimina comentario en anuncio */
	public function borrarComentario($comentario_id)
	{
		$comentario = $this->comentarioRepo->buscarComentario($comentario_id);

		if ($comentario->usuario_id == \Auth::id() & $comentario->estatus != "denunciado")
		{
			$this->comentarioRepo->borrarComentario($comentario);

			return \Redirect::back()->with('comentario_estatus_ok',
										   'Su comentario ha sido eliminado correctamente');
		}

		if ($comentario->estatus == "denunciado")
		{
			return \Redirect::back()->with('comentario_estatus_error',
										   'El comentario no puede ser eliminado porque fue denunciado, 
										    será revisado por un administrador');
		}
		
		return \Redirect::back()->with('comentario_estatus_error','El comentario no pudo ser eliminado');
	}

	/* Elimina respuesta de comentario en anuncio*/
	public function borrarRespuesta($respuesta_id)
	{
		$respuesta = $this->respuestaRepo->buscarRespuesta($respuesta_id);

		if ($respuesta->usuario_id == \Auth::id() & $respuesta->estatus != "denunciado")
		{
			$this->respuestaRepo->borrarRespuesta($respuesta);

			return \Redirect::back()->with('comentario_estatus_ok',
										   'Su respuesta ha sido eliminada correctamente');
		}

		if ($respuesta->estatus == "denunciado")
		{
			return \Redirect::back()->with('comentario_estatus_error',
										   'La respuesta no puede ser eliminada porque fue denunciada, 
										    será revisada por un administrador');
		}

		return \Redirect::back()->with('comentario_estatus_error','La respuesta no pudo ser eliminada');
	}
}
