<?php namespace Anuncia\Asistentes;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- obtener mensajes de estado de usuario
 * 
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */




class Mensajero
{
	protected $accion;
	protected $archivo = 'mensajes.';
	protected $estado;
	protected $mensajes;
	
	
	public function __construct($peticion)
	{
		$this->estado = $peticion['estado'];
		$this->accion = $peticion['accion'];
	} 
	
	/* Devuelve un array con el correspondiente mensaje extraido del archivo mensajes.php*/
	// miradita/app/config/mensajes.php
	public function getMensaje()
	{
		$this->mensajes = \Config::get($this->archivo.$this->accion.'.'.$this->estado);
		
		
		return $this->mensajes;
	}
	
	
}
