<?php  namespace super;

use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\NotificacionRepo;

/**
 * ----------------------------------------------------
 * Clase que : 
 * 		- Muestra el Panel Sistema de la aplicación
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


class SistemaController extends \BaseController
{
	protected $anuncioRepo;
	protected $notificacionRepo;
	
	public function __construct(AnuncioRepo $anuncioRepo,
								NotificacionRepo $notificacionRepo)
	{
		$this->anuncioRepo = $anuncioRepo;
		$this->notificacionRepo = $notificacionRepo;
	}

	/* Muestra el Panel de Sistema */
	public function panelSistema()
	{
		
		$numAnunciosExpirados = $this->getNumeroAnunciosExpirados();
		$numNotificacionesExpiradas = $this->getNumeroNotificacionesExpiradas();
		$numAnunciosOcupados = $this->getNumeroAnunciosOcupados();

		return \View::make('modulos.super.panelsystem', 
							compact('numAnunciosExpirados',
									'numNotificacionesExpiradas',
									'numAnunciosOcupados')

				);


	}

	/* Obtiene el número de notificaciones expiradas */
	public function getNumeroNotificacionesExpiradas()
	{
		return $this->notificacionRepo->enumerarNotificacionesExpiradas();		
	}


	/* Obtiene el número de anuncios expirados */
	public function getNumeroAnunciosExpirados()
	{
		return $this->anuncioRepo->enumerarAnunciosExpirados();		
	}
	
	/* Obtiene el número de anuncios ocupados */
	public function getNumeroAnunciosOcupados()
	{
		return $this->anuncioRepo->enumerarAnunciosOcupados();		
	}

}
