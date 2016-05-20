<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Pregunta;

class PreguntaRepo extends BaseRepo
{
	public function getModel()
	{
		return new Pregunta;	
	}
	
	/* Busca pregunta por id */
	public function buscarPregunta($id)
	{
		$pregunta = Pregunta::find($id);
		
		return $pregunta;
	}

	
}
