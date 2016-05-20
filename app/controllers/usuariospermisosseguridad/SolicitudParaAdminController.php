<?php namespace usuariospermisosseguridad;

use Anuncia\Repositorios\PostulanteRepo;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- postular para administrador del sistema
 * 
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class SolicitudParaAdminController extends \BaseController
{
	protected $postulanteRepo;

	/*Constructor para asignar el repositorio que manipulará la entidad Postulante */
	public function __construct(PostulanteRepo $postulanteRepo)
	{
		$this->postulanteRepo = $postulanteRepo;		
	}

	/* Envía  solicitud para se administrador */
	public function postularAdministrador()
	{
		$usuarioId = \Auth::id();

		$postulante = $this->postulanteRepo->buscarPostulante($usuarioId);

		if (empty($postulante))
		{
			$postulante = $this->postulanteRepo->nuevoPostulante($usuarioId);
			
			$this->postulanteRepo->save($postulante);
		}

		return \View::make('mensajes.postulacion');
	}
}