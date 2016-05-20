<?php namespace anuncios;

use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\ComentarioRepo;
use Anuncia\Repositorios\HistorialanuncioRepo;
use Anuncia\Managers\AnuncianteManager;
use Anuncia\Managers\ComentarioManager;

class VisualizaAnuncioController extends \BaseController
{
	protected $anuncioRepo;
	protected $comentarioRepo;
	protected $historialanuncioRepo;

	public function __construct(AnuncioRepo $anuncioRepo,
								ComentarioRepo $comentarioRepo,
								HistorialanuncioRepo $historialanuncioRepo)
	{
		$this->anuncioRepo = $anuncioRepo;
		$this->comentarioRepo = $comentarioRepo;
		$this->historialanuncioRepo = $historialanuncioRepo;

	}

	/* Muestra en forma detallada anuncio */
	public function verAnuncio($seccion, $anuncioId)
	{
		$anuncio = $this->anuncioRepo->buscarAnuncioId($anuncioId);
		$this->notFoundUnLess($anuncio);


		
		$comentarios = $this->comentarioRepo->cargarComentarios($anuncio->id);
		
		$vista = $this->cargarVistaCorrespondiente($anuncio);



		$ultimaHistoria = $this->historialanuncioRepo->cargarUltimaHistoria($anuncioId);
		//$administrador = $this->usuarioRepo->buscarUsuario($anuncio->admin);



		// Si el anuncio está activado, puede visualizarlo cualquier usuario
		if ($anuncio->estado_id == 1)
		{
			return \View::make($vista , 
								compact('anuncio', 'comentarios','ultimaHistoria')
					);
		}
		// Si estado del anuncio es distinto de activado puede visualizarlo su dueño
		// Ningún otro usuario puede visualizarlo así utilice la url para compartir anuncio
		
		// Si anuncio está desactivado, bloqueado, en revisión, denunciado o rechazado
		else if ($anuncio->estado_id !=1 & \Auth::id() == $anuncio->usuario_id)
		{
			return \View::make($vista , 
							  compact('anuncio', 'comentarios','ultimaHistoria')
					);
		}
		// Si estado del anuncio es distinto de activado solo puede visualizarlo su dueño y los administradores
		// Es necesario en caso de que anuncio sea denunciado
		else if ($anuncio->estado_id != 1 & \Auth::check())
		{
			if (is_admin())
			{
				return \View::make($vista , 
								  compact('anuncio', 'comentarios','ultimaHistoria')
						);
			}
			
			return \View::make('mensajes.anuncionodisponible');
		}
		
		return \View::make('mensajes.anuncionodisponible');
	}



	public function cargarVistaCorrespondiente($anuncio)
	{
		// Si anuncio pertenece a sección Clasificados
		if ($anuncio->seccion_id == 1)
		{
			return 'modulos.anuncios.ver.clasificado';
		}
		// Si anuncio pertenece a sección Servicios
		else if ($anuncio->seccion_id == 2)
		{
			return 'modulos.anuncios.ver.servicio'; 
		}
		// Si anuncio pertenece a sección Empleos
		else if($anuncio->seccion_id == 3)
		{
			return  'modulos.anuncios.ver.empleo'; 
		}
	}
}