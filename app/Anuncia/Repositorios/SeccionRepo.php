<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Seccion;

class SeccionRepo extends BaseRepo
{
	public function getModel()
	{
		return new Seccion;	
	}
	
	public function buscarNombreSeccion($id)
	{
		$seccion = Seccion::find($id);
		
		return $seccion;
	}
}
