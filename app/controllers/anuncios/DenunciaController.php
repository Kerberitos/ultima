<?php namespace anuncios;

use Anuncia\Managers\DenunciaManager;

use Anuncia\Repositorios\DenunciaRepo;
use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\ComentarioRepo;
use Anuncia\Repositorios\RespuestaRepo;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Denunciar anuncios, comentarios y respuestas
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

class DenunciaController extends \BaseController
{
	protected $denunciaRepo;
	protected $anuncioRepo;
	protected $comentarioRepo;
	protected $respuestaRepo;

	public function __construct(DenunciaRepo $denunciaRepo,
								AnuncioRepo $anuncioRepo,
								ComentarioRepo $comentarioRepo,
								RespuestaRepo $respuestaRepo )
	{
		$this->denunciaRepo = $denunciaRepo;
		$this->anuncioRepo = $anuncioRepo;
		$this->comentarioRepo = $comentarioRepo;
		$this->respuestaRepo = $respuestaRepo;
	}

	/* Denuncia (reporta) anuncio publicado a un administrador */
	public function denunciarAnuncio()
	{
		
		
		# usuario que inició sesión
		$usuario = \Auth::user();
		$denuncianteId = $usuario->id;

		$denuncia = $this->denunciaRepo->nuevaDenuncia($denuncianteId);

		$manager = new DenunciaManager($denuncia, \Input::all());
		
		$anuncio = $this->anuncioRepo->buscarAnuncioId(\Input::get('identificativo'));

		if ($this->existe($anuncio))
		{
			# estado 1 = anuncio activo
			if ($anuncio->estado_id == 1)
			{
				

				if ($manager->isValid())
				{
					$denuncia->justificacion = \Helper::purificarCadena(\Input::get('denuncia'));
					$denuncia->tipodedenuncia = "anuncio";
					$manager->save();
					
					$this->anuncioRepo->denunciarAnuncio(\Input::get('identificativo'));
					
					return \View::make('mensajes.graciaspordenunciar', 
									   compact('usuario')
							);
				}
						
				return \Redirect::back()->with('denuncia_error',
											   'Tu denuncia no pudo ser enviada');
			}
			# estado 6 = anuncio denunciado
			else if ($anuncio->estado_id == 6)
			{
				return \View::make('mensajes.anuncioyadenunciado',
							   compact('usuario')
						);
			}
			else
			{
				return \View::make('mensajes.anuncionodisponible');
			}
		}
		
		return \View::make('mensajes.anuncionodisponible');
	}

	/* Verifica si existe el objeto enviado */
	public function existe($objeto)
	{
		if(!empty($objeto))
		{
			return true;
		}
		
		return false;
	}


	/* Denuncia (reporta) comentario a un administrador */
	public function denunciarComentario($comentarioId, $denunciadoId)
	{
		$comentario = $this->comentarioRepo->buscarComentario($comentarioId);
		
		if ($this->existe($comentario))
		{
			if (! $comentario->estatus){
			
				$denuncianteId = \Auth::id();
			
				$denuncia = $this->denunciaRepo->nuevaDenuncia($denuncianteId);
				$denuncia->denunciado_id = $denunciadoId;
				$denuncia->identificativo = $comentarioId;


				$denuncia->politica_id=1;
				$denuncia->justificacion='no';



				$denuncia->tipodedenuncia = "comentario";
				$this->comentarioRepo->denunciarComentario($comentarioId);
				$denuncia->save();
				
				return \Redirect::back()->with('comentario_estatus_ok',
											   'El comentario que has denunciado será revisado por un administrador');	
				
			}

			return \Redirect::back()->with('comentario_estatus_ok',
										   'El comentario ya ha sido denunciado');

		}
		return \Redirect::back()->with('comentario_estatus_ok',
									   'El comentario ya no se encuentra disponible');
	}

	/* Denuncia (reporta) respuesta a un administrador */
	public function denunciarRespuesta($respuestaId, $denunciadoId)
	{
		$respuesta = $this->respuestaRepo->buscarRespuesta($respuestaId);
		
		if ($this->existe($respuesta))
		{
			if(! $respuesta->estatus){

				$denuncianteId = \Auth::id();
				$denuncia = $this->denunciaRepo->nuevaDenuncia($denuncianteId);
				$denuncia->denunciado_id = $denunciadoId;
				$denuncia->identificativo = $respuestaId;

				$denuncia->politica_id=1;
				$denuncia->justificacion='no';



				$denuncia->tipodedenuncia = "respuesta";

				$this->respuestaRepo->denunciarRespuesta($respuestaId);
				$denuncia->save();
			
				return \Redirect::back()->with('comentario_estatus_ok',
											   'La respuesta que has denunciado será revisada por un administrador');
			}

			return \Redirect::back()->with('comentario_estatus_ok',
											   'La respuesta ya ha sido denunciada');
		}
		return \Redirect::back()->with('comentario_estatus_ok',
									   'La respuesta ya no se encuentra disponible');
	}
}
