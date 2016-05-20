<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Notificacion;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class NotificacionRepo extends BaseRepo
{
	public function getModel()
	{
		return new Notificacion;	
	}
	
	public function nuevaNotificacion($usuario_id)
	{
		$notificacion = new Notificacion();
		$notificacion->usuario_id = $usuario_id;
		$notificacion->estatus_visto = "novisto";
	
		return $notificacion;
	}

	/* Carga todas las notificaciones expiradas */
	public function notificacionesExpiradas()
	{
		$fechahoy = Carbon::now()->toDateString();

		$notificaciones = Notificacion::where('expiradate','<', $fechahoy)->orWhere('estatus_visto','=',"visto")->get();

		return $notificaciones;
	}

	/* Obtiene el número de notificaciones expiradas*/
	public function enumerarNotificacionesExpiradas()
	{
		return $this->notificacionesExpiradas()->count();	
	}

	/* Obtiene el número de notificaciones no revisadas de usuario */
	public function numeroNotificacionesNoRevisadas($usuario_id)
	{
		return Notificacion::where('usuario_id','=', $usuario_id)->where('estatus_visto','=', 'novisto')->count();
	}

	/* Elimina notificaciones expiradas*/
	public function eliminarNotificacionesExpiradas($notificaciones)
	{
		foreach ($notificaciones as $notificacion) {
			$notificacion->delete();
		}
		return true;
	}

	






	public function notificacionAnuncioPublicado($notificacion, $anuncio)
	{
		$notificacion->notificacion = "publicado";
		$notificacion->tipo = "anuncio";
		$notificacion->identificativo = $anuncio->id;
		$notificacion->expiradate = Date::now()->addDays(5);
		$notificacion->save();
	}

	public function notificacionAnuncioRechazado($notificacion, $anuncio)
	{
		$notificacion->notificacion = "rechazado";
		$notificacion->tipo = "anuncio";
		$notificacion->identificativo = $anuncio->id;
		$notificacion->expiradate = Date::now()->addDays(5);
		$notificacion->save();
	}
	
	public function notificacionAnuncioBloqueado($notificacion, $anuncio)
	{
		$notificacion->notificacion = "bloqueado";
		$notificacion->tipo = "anuncio";
		$notificacion->identificativo = $anuncio->id;
		$notificacion->expiradate = Date::now()->addDays(5);
		$notificacion->save();
	}

	public function notificacionPromovidoaAdministrador($notificacion)
	{
		$notificacion->notificacion = "promovido";
		$notificacion->tipo = "system";
		$notificacion->expiradate = Date::now()->addDays(5);
		//$notificacion->identificativo=$anuncio->id;
		$notificacion->save();
	}

	public function notificacionRechazadaSolicitud($notificacion)
	{
		$notificacion->notificacion = "nopromovido";
		$notificacion->tipo = "system";
		$notificacion->expiradate = Date::now()->addDays(5);
		//$notificacion->identificativo=$anuncio->id;
		$notificacion->save();
	}

	public function notificacionComentario($notificacion, $anuncio)
	{
		$notificacion->notificacion = "comentario";
		$notificacion->tipo = "comentario";
		$notificacion->identificativo = $anuncio->id;
		$notificacion->estatus_visto = "novisto";
		$notificacion->created_at = Date::now();
		$notificacion->expiradate = Date::now()->addDays(5);
		$notificacion->save();
	}

	public function notificacionRespuesta($notificacion, $anuncio)
	{
		$notificacion->notificacion = "respuesta";
		$notificacion->tipo = "comentario";
		$notificacion->identificativo = $anuncio->id;
		$notificacion->estatus_visto = "novisto";
		$notificacion->created_at = Date::now();
		$notificacion->expiradate = Date::now()->addDays(5);
		$notificacion->save();
	}
	public function notificacionAccion($notificacion, $anuncio)
	{
		$notificacion->notificacion = "acciones";
		$notificacion->tipo = "comentario";
		$notificacion->identificativo = $anuncio->id;
		$notificacion->estatus_visto = "novisto";
		$notificacion->created_at = Date::now();
		$notificacion->expiradate = Date::now()->addDays(5);
		$notificacion->save();
	}

	/* Establece notificacion como revisada*/
	public function marcarComoRevisada($notificacion_id)
	{
		$notificacion=$this->buscar_notificacion($notificacion_id);
		$notificacion->estatus_visto="visto";
		$notificacion->save();
	
		return true;
	}


	
	public function existeNotificacionComentario($usuario_id, $identificativo)
	{
		return Notificacion::where('notificacion','=', "comentario")->where('usuario_id','=', $usuario_id )->where('tipo','=', "comentario")->where('identificativo','=', $identificativo)->first();
	}

	public function existeNotificacionRespuesta($usuario_id,  $identificativo)
	{
		return Notificacion::where('notificacion','=', "respuesta")->where('usuario_id','=', $usuario_id )->where('tipo','=', "comentario")->where('identificativo','=', $identificativo)->first();
	}
	
	public function existeNotificacionAccion($usuario_id, $identificativo)
	{
		return Notificacion::where('notificacion','=', "acciones")->where('usuario_id','=', $usuario_id )->where('tipo','=', "comentario")->where('identificativo','=', $identificativo)->first();
	}

	public function buscar_notificacion($notificacion_id)
	{
		return Notificacion::find($notificacion_id);
	}

}
