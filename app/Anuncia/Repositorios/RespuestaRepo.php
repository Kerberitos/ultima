<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Respuesta;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class RespuestaRepo extends BaseRepo
{
	public function getModel()
	{
		return new Respuesta;	
	}
	
	public function newRespuesta($usuario_id)
	{
		$respuesta = new Respuesta();
		$respuesta->usuario_id = $usuario_id;
		
		return $respuesta;
	}
	
	/* *Devuelve el número de respuestas denunciadas  */
	public function enumerarRespuestasDenunciadas()
	{
		return Respuesta::where('estatus','=','denunciado')->count();
	}

	/* *Devuelve el número de respuestas denunciadas ocupadas por un administrador (En revisión anuncio denunciado ) */
	public function enumerarRespuestasDenunciadasPendientes($usuario_id)
	{
		return Respuesta::where('estatus','=','denunciado')->where('admin','=', $usuario_id)->count();
	}










	/* Busca una respuesta mediante su id*/ 
	public function buscarRespuesta($id)
	{
		return Respuesta::find($id);
	}

	/* Devuelve todas las respuestas denunciadas */
	public function buscarRespuestasDenunciadas()
	{
		return Respuesta::where('estatus','=','denunciado')->paginate(3);
	}

	/* Devuelve todas las respuestas denunciadas pendientes*/
	public function respuestasDenunciadasPendientes($usuario_id)
	{
		return Respuesta::where('estatus','=','denunciado')->where('admin','=', $usuario_id)->paginate(4);
	}

	/* Elimina respuesta */
	public function eliminarRespuestaId($respuesta_id)
	{
		$respuesta = $this->buscarRespuesta($respuesta_id);
		
		if ($respuesta->delete())
		{
			return true;
		}

		return false;
	}

	/* Establece el estatus de revision de la respuesta como ocupado */
	public function estatusRevisionOcupado($respuesta, $admin)
	{
		$respuesta->estatus_revision = "ocupado";
		$respuesta->admin = $admin;
		$respuesta->save();
	}

	/* Reactiva y libera la respuesta */
	public function reactivarRespuestaId($respuesta_id)
	{
		$respuesta = Respuesta::find($respuesta_id);
		$respuesta->estatus = "";
		$respuesta->estatus_revision = "";
		$respuesta->admin = 0;
		
		if($respuesta->save())
		{
			return true;
		}
	}

	/* Denuncia respuesta */
	public function denunciarRespuesta($id)
	{
		$respuesta = Respuesta::find($id);
		$respuesta->estatus = "denunciado";
		$respuesta->estatus_revision = "libre";
		$respuesta->save();
	}









	
	
	public function borrarRespuesta($respuesta)
	{
		$respuesta->delete();
	}


}
