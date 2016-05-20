<?php namespace anuncios;

use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\AnuncianteRepo;
use Anuncia\Repositorios\PreguntaRepo;
use Anuncia\Repositorios\ComentarioRepo;

use Anuncia\Managers\ClasificadoManager;
use Anuncia\Managers\ServicioManager;
use Anuncia\Managers\EmpleoManager;
use Anuncia\Managers\AnuncianteManager;
use Anuncia\Managers\ComentarioManager;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Gestionar (solicitar publicación, desactivar, eliminar) anuncios a un usuario
 *
 * Nota importante: Para visualizar un anuncio se utiliza 
 * la clase miradita/app/controllers/VisualizarAnuncioControler.php
 * No está incluida en en el módulo administración por  
 *
 * ----------------------------------------------------
 * Rutas:
 * 		- miradita/app/routes/auth.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class GestionAnuncioController extends \BaseController
{
	protected $anuncioRepo;
	protected $anuncianteRepo;
	protected $comentarioRepo;
	protected $preguntaRepo;

	public function __construct(AnuncioRepo $anuncioRepo,
								AnuncianteRepo $anuncianteRepo,
								PreguntaRepo $preguntaRepo,
								ComentarioRepo $comentarioRepo)
	{
		$this->anuncioRepo=$anuncioRepo;
		$this->anuncianteRepo=$anuncianteRepo;
		$this->preguntaRepo=$preguntaRepo;
		$this->comentarioRepo=$comentarioRepo;
	}
	
	/* Muestra todos los anuncios creados por el usuario */	
	public function mostrarMisAnuncios()
	{
		$usuario_id = \Auth::id();
		$anuncios = $this->anuncioRepo->buscarAnunciosDeUsuario($usuario_id);

		
		return \View::make('modulos.anuncios.misanuncios', 
							compact('anuncios')
				);
	}
	
	/* Muestra vista donde usuario solicita publicar anuncio */
	public function mostrarSolicitudPublicacion($anuncioId)
	{
		$usuario = \Auth::user()->usuario;

		$idanuncio = array (
								'anuncio_id' => $anuncioId
							);

		return \View::make('modulos.anuncios.solicitarpublicar', 
							compact('usuario','idanuncio')
				);
	}

	/* Envía solicitud para publicación de anuncio */
	public function enviarSolicitudPublicacion($anuncioId)
	{
		$anuncio = $this->anuncioRepo->buscarAnuncioId($anuncioId);
		$this->notFoundUnLess($anuncio);
		
		// Solo los usuarios pueden solicitar publicación sobre sus propios anuncios
		if ($this->perteneceAnuncio($anuncio->usuario_id))
		{
			if ($this->anuncioRepo->establecerEstadoDeRevision($anuncioId))
			{
				return \Redirect::route('misanuncios')->with('status_ok', 
															 'Solicitud para publicación enviada correctamente');
			}
				
			return \Redirect::route('misanuncios')->with('status_error',
														 'No se pudo enviar la solicitud');
		}
		return	\App::abort(404);
	}

	/* Elimina anuncio  */
	public function eliminarAnuncio($anuncioId)
	{
		$anuncio = $this->anuncioRepo->buscarAnuncioId($anuncioId);
		$this->notFoundUnLess($anuncio);
		
		if ($this->perteneceAnuncio($anuncio->usuario_id))
		{
			if ($this->esBorrable($anuncio))
			{
				try{
					
					\DB::beginTransaction();

					if ($this->eliminarAnunciante($anuncioId))
					{
						foreach ($anuncio->comentarios as $comentario)
						{
							$this->comentarioRepo->borrarComentario($comentario);
						}

						if ($this->anuncioRepo->eliminarAnuncio($anuncioId))
						{
							$this->eliminarDirectorioFotos(public_path().'/uploads/'.$anuncioId);
							
							\DB::commit();

							return \Redirect::route('misanuncios')->with('status_ok', 
																		 'Anuncio eliminado correctamente');
						}
						
						return \Redirect::route('misanuncios')->with('status_error', 
																	 'No se pudo eliminar el anuncio');	
					}
					
					return \Redirect::route('misanuncios')->with('status_error', 
															 'No se pudo eliminar el anunciante');
				}
				catch(\Exception $ex)
				{
					\DB::rollback();
					\Session::flash('error_de_servidor',1);
					return \Redirect::back();
				}	
			}
			return \Redirect::route('misanuncios')->with('status_error', "Su anuncio no puede ser eliminado
														 en este momento, debido al estado de 
														 $anuncio->estado_title que posee");
		}
		
		return \App::abort(404);
	}

	/* Verifica si el anuncio pertenece al usuario que solicita alguna acción*/
	public function perteneceAnuncio($usuarioDelAnuncio)
	{
		$usuarioActual = \Auth::id();
		
		if ($usuarioDelAnuncio == $usuarioActual)
		{
			return true;
		}
		return false;
	}

	/* Verifica si anuncio puede ser borrado*/
	public function esBorrable($anuncio)
	{
		// No se puede elimina anuncio con estado de bloqueado o denunciado
		if(($anuncio->estado_id == 1) | ($anuncio->estado_id == 2) | ($anuncio->estado_id == 5) | ($anuncio->estado_id == 7))
		{
			return true;
		}

		return false;
	}

	/* Elimina anunciante de anuncio*/
	public function eliminarAnunciante($anuncianteId)
	{
		if($this->anuncianteRepo->borraranuncianteanuncio($anuncianteId))
		{
			return true;
		}
		
		return false;
	}

	/* Elimina el directorio de fotos de un anuncio */
	public function eliminarDirectorioFotos($carpeta)
	{
		if(is_dir($carpeta))
		{
			foreach (glob($carpeta . "/*") as $archivos_carpeta){
				unlink($archivos_carpeta);
			} 
			rmdir($carpeta);
		}
	}

	/* Desactiva anuncio */
	public function desactivarAnuncio($anuncioId)
	{
		$anuncio= $this->anuncioRepo->buscarAnuncioId($anuncioId);
		$this->notFoundUnLess($anuncio);
		
		if ($this->perteneceAnuncio($anuncio->usuario_id))
		{
			// si el anuncio está activo se puede desactivar
			if($anuncio->estado_id == 1)
			{
				if($this->anuncioRepo->desactivarAnuncio($anuncioId))
				{
					return \Redirect::route('misanuncios')->with('status_ok', 
																 'Anuncio desactivado correctamente');
				}
				
				return \Redirect::route('misanuncios')->with('status_error',
														 'No se pudo desactivar el anuncio');
			}

			return \Redirect::route('misanuncios')->with('status_error',
														 'El anuncio no se escuentra activo,
														  así que no puede desactivarse');	
		}
		return \App::abort(404);
	}
}
