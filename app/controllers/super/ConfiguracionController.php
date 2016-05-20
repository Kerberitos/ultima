<?php  namespace super;

use Anuncia\Repositorios\ConfiguracionRepo;

use Anuncia\Managers\ConfiguracionManager;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Manipular todo lo referente a la configuración de la aplicación
 * Configuraciones como:
 *				-> Número de auncios bloqueados permitidos
 *				-> Número de comentarios eliminados permitidos por infringir las normas de uso
 *				-> Número de anuncios permitidos que puede crear un usuario en la aplicación
 *				-> Número de anuncios permitidos que puede crear un Administrador
 *				-> Contador de denuncias (denuncias falsas - denuncias verdaderas)
 *				-> Permitir envío de solicitudes para ser administrador			
 * 
 * ----------------------------------------------------
 * Rutas:
 * 		- miradita/app/routes/super.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class ConfiguracionController extends \BaseController
{

	protected $configuracionRepo;

	public function __construct(ConfiguracionRepo $configuracionRepo)
	{
		$this->configuracionRepo=$configuracionRepo;
	}

	/* Muestra configuración de la aplicación */
	public function verConfiguracion()
	{
		$configuracion= $this->configuracionRepo->cargarConfiguracionActual();
		
		return \View::make('modulos.super.configuraciones', compact('configuracion'));
	}

	/* Guarda configuración */
	public function guardarConfiguracion()
	{
		$configuracion = $this->configuracionRepo->cargarConfiguracionActual();
				
		$manager = new ConfiguracionManager($configuracion, \Input::all());

		if ($manager->save())
		{
			return \Redirect::route('super.configuraciones')->with('status_ok',
																   'Configuracion guardada correctamente');
		}

		return \Redirect::back()->withInput()->withErrors($manager->getErrores());
	}

}
