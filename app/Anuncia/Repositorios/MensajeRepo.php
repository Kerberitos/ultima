<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Mensaje;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class MensajeRepo extends BaseRepo
{
	public function getModel()
	{
		return new Mensaje;	
	}
	
	public function nuevoMensaje($remitente_id)
	{
		$mensaje = new Mensaje();

		$mensaje->remitente_id = $remitente_id;
		$mensaje->estatus_visto = "noleido";

		return $mensaje;
	}

	/* Devuelve los mensajes buscando por id de usuario */
	public function buscarMensajes($usuario_id)
	{
		return Mensaje::where('usuario_id','=', $usuario_id)->orderBy('created_at', 'desc')->paginate(12);
	}
	
	/* Devuelve el número de mensajes no leidos mediante el id de usuario */
	public function numeroMensajesNoLeidos($usuario_id)
	{
		return Mensaje::where('usuario_id','=', $usuario_id)->where('estatus_visto','=', 'noleido')->count();
	}
	
	/* Busca mensaje mediante su id*/	
	public function buscarMensajeId($mensaje_id)
	{
		return Mensaje::find($mensaje_id);
	}

	/* Establece a mensaje como leido */
	public function marcarComoLeido($mensaje_id)
	{
		$mensaje = $this->buscarMensajeId($mensaje_id);
		$mensaje->estatus_visto = "leido";
		$mensaje->save();
	
		return true;
	}
	
	/* Elimina mensaje*/
	public function eliminarMensaje($mensaje)
	{
		if($mensaje->delete())
		{
			return true;
		}
		
		return false;		
	}
}
