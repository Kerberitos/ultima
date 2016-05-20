<?php namespace Anuncia\Entidades;

class Alerta extends \Eloquent
{
	protected $table = 'alertas';
	
	protected  $fillable = array(
			
	);

	public function usuario()
	{
    	return $this->belongsTo('Anuncia\Entidades\Usuario');
    }
}