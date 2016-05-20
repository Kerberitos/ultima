<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Configuracion;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class ConfiguracionRepo extends BaseRepo
{
	public function getModel()
	{
		return new Configuracion;	
	}
	
	public function nuevaConfiguracion()
	{
		$configuracion = new Configuracion();
		
		return $configuracion;
	}

	public function cargarConfiguracionActual()
	{
		return Configuracion::find(1);
	}

	


}
