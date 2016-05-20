<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Denuncia;

class DenunciaRepo extends BaseRepo
{
	public function getModel()
	{
		return new Denuncia;	
	}
	
	public function nuevaDenuncia($denunciante_id)
	{
		$denuncia = new Denuncia();
		$denuncia->denunciante_id = $denunciante_id;
		
		return $denuncia;
	}

	/* elimina denuncia tipo anuncio */
	public function eliminarDenunciaTipoAnuncio($anuncio_id)
	{
		$denuncia = $this->buscarDenunciaTipoAnuncio($anuncio_id);
		
		if($denuncia->delete())
		{
			return true;
		}
	
		return false;
	}

	/* busca denuncia de tipo anuncio mediante el id del anuncio denunciado */
	public function buscarDenunciaTipoAnuncio($anuncio_id)
	{
		return Denuncia::where('identificativo','=', $anuncio_id)->where('tipodedenuncia','=', "anuncio")->first();
	}

	/* elimina denuncia tipo comentario */
	public function eliminarDenunciaTipoComentario($comentario_id)
	{
		$denuncia=$this->buscarDenunciaTipoComentario($comentario_id);
		
		if($denuncia->delete())
		{
			return true;
		}
	
		return false;
	}

	/* busca denuncia de tipo comentario mediante el id del comentario denunciado */
	public function buscarDenunciaTipoComentario($comentario_id)
	{
		return Denuncia::where('identificativo','=', $comentario_id)->where('tipodedenuncia','=', "comentario")->first();
	}

	/* elimina denuncia tipo respuesta */
	public function eliminarDenunciaTipoRespuesta($respuesta_id)
	{
		$denuncia = $this->buscarDenunciaTipoRespuesta($respuesta_id);
	
		if($denuncia->delete())
		{
			return true;
		}
	
		return false;
	}

	/* busca denuncia de tipo respuesta mediante el id de la respuesta denunciada */
	public function buscarDenunciaTipoRespuesta($respuesta_id)
	{
		return Denuncia::where('identificativo','=', $respuesta_id)->where('tipodedenuncia','=', "respuesta")->first();
	}

	
	public function save()
	{
		$this->save();
	}
}
