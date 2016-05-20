<?php namespace Anuncia\Entidades;

class Pregunta extends \Eloquent
{
	protected $table = 'preguntas';
	
	public function seccion()
	{
		return $this->belongsTo('Anuncia\Entidades\Seccion');
	}
}