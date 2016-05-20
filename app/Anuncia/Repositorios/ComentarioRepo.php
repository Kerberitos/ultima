<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Comentario;

use Carbon\Carbon;
use Jenssegers\Date\Date;


class ComentarioRepo extends BaseRepo
{
	public function getModel()
	{
		return new Comentario;	
	}

	public function nuevoComentario($usuario_id)
	{
		$comentario = new Comentario();
		
		$comentario->usuario_id = $usuario_id;
		
		return $comentario;
	}

	/* *Devuelve el número de comentarios denunciados  */
	public function enumerarComentariosDenunciados()
	{
		return Comentario::where('estatus','=','denunciado')->count();	
	}
	
	/* *Devuelve el número de comentarios denunciados ocupados por un administrador (En revisión anuncio denunciado ) */
	public function enumerarComentariosDenunciadosPendientes($usuario_id)
	{
		return Comentario::where('estatus','=','denunciado')->where('admin','=', $usuario_id)->count();
	}







	/* Busca un comentario mediante su id*/ 
	public function buscarComentario($id)
	{
		return Comentario::find($id);
	}

	/* Devuelve todos los comentarios denunciados */
	public function buscarComentariosDenunciados()
	{
		return Comentario::where('estatus','=','denunciado')->paginate(3);
	}

	/* Obtiene todos los comentarios de un anuncio */
	public function cargarComentarios($anuncio_id)
	{
		return Comentario::where('anuncio_id','=', $anuncio_id)->get();//->paginate(12);
	}

	/* Devuelve todos los comentarios denunciados pendientes*/
	public function comentariosDenunciadosPendientes($usuario_id)
	{
		return Comentario::where('estatus','=','denunciado')->where('admin','=', $usuario_id)->paginate(4);
	}

	/* Denuncia comentario */
	public function denunciarComentario($id)
	{
		$comentario = Comentario::find($id);
		$comentario->estatus = "denunciado";
		$comentario->estatus_revision = "libre";
		$comentario->save();
	}

	/* Elimina comentario y sus respuestas */
	public function eliminarComentarioId($comentario_id)
	{
		$comentario = $this->buscarComentario($comentario_id);
		
		$comentario->respuestas()->delete();

		if ($comentario->delete())
		{
			return true;
		}

		return false;
	}

	/* Establece el estatus de revision del comentario como ocupado */
	public function estatusRevisionOcupado($comentario, $admin)
	{
		$comentario->estatus_revision = "ocupado";
		$comentario->admin = $admin;
		$comentario->save();
	}

	/* Reactiva y libera el comentario */
	public function reactivarComentarioId($comentario_id)
	{
		$comentario = Comentario::find($comentario_id);
		$comentario->estatus = "";
		$comentario->estatus_revision = "";
		$comentario->admin = 0;
		
		if($comentario->save()) 
		{
			return true;
		}
	}

	














	

	public function borrarComentario($comentario)
	{
		$comentario->respuestas()->delete();
		$comentario->delete();
	}

	
}