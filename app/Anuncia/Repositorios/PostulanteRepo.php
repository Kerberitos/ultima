<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Postulante;

class PostulanteRepo extends BaseRepo
{

	public function getModel()
	{
		return new Postulante;	
	}
	
	public function nuevoPostulante($usuario_id)
	{
		$postulante = new Postulante();
		$postulante->usuario_id = $usuario_id;
		
		return $postulante;
	}

	/* Carga usuarios postulantes a administradores */
	public function postulantes()
	{
		return Postulante::where('id','<>', 0)->paginate(1);
	}

	/* Obtiene número de usuarios postulantes a administradores */	
	public function enumerarPostulantes()
	{
		return Postulante::all()->count();	
	}

	/* Busca postulante mediante el id de usuario */
	public function buscarPostulante($usuario_id)
	{
		return Postulante::where('usuario_id','=', $usuario_id)->first();
	}	

	/* Elimina postulante a administrador */
	public function borrarPostulante($usuario_id)
	{
		$postulante = $this->buscarPostulante($usuario_id);
	
		if ($postulante->delete())
		{
			return true;
		}
		
		return false;
	}




	public function save($postulante)
	{
		$postulante->save();
	}



	

}