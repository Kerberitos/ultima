<?php namespace Anuncia\Entidades;

class Postulante extends \Eloquent
{
	protected $table = 'postulantes';

	protected $fillable = array(
			
	);

	public function usuario(){
        return $this->belongsTo('Anuncia\Entidades\Usuario');
    }
}