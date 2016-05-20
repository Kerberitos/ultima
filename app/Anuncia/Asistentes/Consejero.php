<?php namespace Anuncia\Asistentes;

/*use Anuncia\Entidades\Usuario;

use Anuncia\Repositorios\UsuarioRepo;*/

/*class Consejero
{
	protected $accion;
	protected $correo;
	protected $data;
	protected $estado;
	protected $usuarioRepo;
	/*

	/*
	* los posibles valores para $accion que llegan
	*
	* 'ingresar' cuando el usuario desea iniciar sesión 
	* 'registrar' cuando el usuario desea registrarse
	* 'conectar' cuando el usuario desea conectarse con red social
	*
	*/
/*	public function __construct($correo, $accion)
	{
		$this->correo = $correo;
		$this->accion = $accion;
		$this->usuarioRepo = new UsuarioRepo;
	}*/

	/* Devuelve un array con estado y acción si existe usuario, caso contrario array vacio */
/*	public function getConsejo()
	{
		if ($this->existeUsuario())
		{
			$this->data = array(
								'estado' => $this->estado,	
								'accion' => $this->accion	
			);
		}
		
		return $this->data;
	}*/
	
	/* Verifica se existe usuario mediante su correo */
/*	public function existeUsuario()
	{
		$this->estado = $this->usuarioRepo->getEstado($this->correo);
		
		if (empty($this->estado))
		{
			return false;		
		}
		
		return true;
	}
}*/