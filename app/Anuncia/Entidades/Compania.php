<?php namespace Anuncia\Entidades;

class Compania extends \Eloquent
{
	public function usuarios()
    {
    	return $this->hasMany('Usuario');
    }
	
}