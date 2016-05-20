<?php namespace anuncios;

use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\AnuncianteRepo;
use Anuncia\Repositorios\PreguntaRepo;

use Anuncia\Managers\ClasificadoManager;
use Anuncia\Managers\ServicioManager;
use Anuncia\Managers\EmpleoManager;
use Anuncia\Managers\AnuncianteManager;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Editar anuncios
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

class EdicionAnuncioController extends \BaseController
{
	protected $anuncioRepo;
	protected $anuncianteRepo;
	protected $preguntaRepo;

	public function __construct(AnuncioRepo $anuncioRepo,
								AnuncianteRepo $anuncianteRepo,
								PreguntaRepo $preguntaRepo)
	{
		$this->anuncioRepo=$anuncioRepo;
		$this->anuncianteRepo=$anuncianteRepo;
		$this->preguntaRepo=$preguntaRepo;
	}

	/* Muestra el formulario edición de anuncio */
	public function mostrarFormularioEdicion($anuncio_id)
	{
		$anuncio = $this->anuncioRepo->buscarAnuncioId($anuncio_id);
		$this->notFoundUnLess($anuncio);
		
		# busca la pregunta del anuncio
		$pregunta = $this->preguntaRepo->buscarPregunta($anuncio->pregunta);

		if ($this->esEditable($anuncio))
		{
			if (\Helper::compararCadenas($anuncio->estatus_revision,"ocupado"))
			{
				return \Redirect::route('misanuncios')->with('status_error', 
															 'Su anuncio está siendo revisado en este 
															 instante, no puede editarlo ahora');
			}

			if ($this->perteneceAnuncio($anuncio->usuario_id))
			{
				$anunciante = $this->anuncianteRepo->buscarAnuncianteId($anuncio->anunciante->id);
			
				if ($anuncio->seccion_id == 1)
				{
					return \View::make('modulos.anuncios.editar.clasificado', 
										compact('anuncio','anunciante','pregunta')
							);	
				}
				else if ($anuncio->seccion_id == 2)
				{
					return \View::make('modulos.anuncios.editar.servicio', 
										compact('anuncio','anunciante','pregunta')
							);	
				}
				else if ($anuncio->seccion_id == 3)
				{
					return \View::make('modulos.anuncios.editar.empleo', 
										compact('anuncio','anunciante','pregunta')
							);
				}
			}
			
			return \App::abort(404);
		}
		
		return \Redirect::route('misanuncios')->with('status_error', "Su anuncio no puede ser editado 
													 en este momento, debido al estado de 
													 $anuncio->estado_title que posee");
	}

	public function esEditable($anuncio)
	{
		$estado = $anuncio->estado_id;
		// anuncios activos, desactivados, en revision, 
		if (($estado == 1) | ($estado == 2) | ($estado == 5) | ($estado == 7)){
			return true;
		}

		return false;
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


	public function editarClasificado()
	{
		$anuncio = $this->anuncioRepo->buscarAnuncioId(\Input::get('anuncio'));
		$anunciante = $anuncio->anunciante;

		$manageranunciante = new AnuncianteManager($anunciante, \Input::all());
		$manageranuncio = new ClasificadoManager($anuncio, \Input::all());

		if ($manageranuncio->isValid())
		{
			if ($manageranunciante->isValid())
			{
				/*Usar purifier para evitar ataques xss*/
				$anuncio->titulo = \Helper::purificarCadena(\Input::get('titulo'));
				$anuncio->descripcion = \Helper::purificarCadena(\Input::get('descripcion'));

				$this->cambiarEstadoADesactivado($anuncio);
	
				$manageranuncio->save();
				/*ruta del directorio pincipal donde se guardarán las fotos subidas por usuarios sobre sus anuncios*/
				$directorio = public_path().'/uploads/';
				$carpetaanuncio = $directorio.$anuncio->id.'/';
				
				if (\Input::hasFile('foto1'))
				{	
					/*Obtener datos del archivo subido temporalmente al servidor*/
					$fotosubida = \Input::file('foto1');
					$extension = $fotosubida->getClientOriginalExtension();
					
					$imagenController = new \imagenes\ImagenController();
					$imagenController->subirfotos($carpetaanuncio, $fotosubida, 1);

					$anuncio->foto1 = '/uploads/'.$anuncio->id.'/'.'mir_foto1'.'.'.$fotosubida->getClientOriginalExtension();

					/*resize imagen para miniatura*/
					$imagenMiniatura = $carpetaanuncio.'miniaturita'.'.'.$extension;
					$intImagen = \Image::make($imagenMiniatura)->resize(120, 120);
					
					$intImagen->save($imagenMiniatura);
					$anuncio->imagen = '/uploads/'.$anuncio->id.'/'.'miniaturita'.'.'.$extension;
				}
				
				if (\Input::hasFile('foto2'))
				{
					$fotosubida = \Input::file('foto2');
					
					$imagenController = new \imagenes\ImagenController();
					$imagenController->subirfotos($carpetaanuncio, $fotosubida, 2);

					$anuncio->foto2 = '/uploads/'.$anuncio->id.'/'.'mir_foto2'.'.'.$fotosubida->getClientOriginalExtension();
				}

				if (\Input::hasFile('foto3'))
				{	
					$fotosubida = \Input::file('foto3');
					
					$imagenController = new \imagenes\ImagenController();
					$imagenController->subirfotos($carpetaanuncio, $fotosubida, 3);

					$anuncio->foto3 = '/uploads/'.$anuncio->id.'/'.'mir_foto3'.'.'.$fotosubida->getClientOriginalExtension();
				}
				
				if (\Input::hasFile('foto4'))
				{
					$fotosubida = \Input::file('foto4');
					
					$imagenController = new \imagenes\ImagenController();
					$imagenController->subirfotos($carpetaanuncio, $fotosubida, 4);

					$anuncio->foto4 = '/uploads/'.$anuncio->id.'/'.'mir_foto4'.'.'.$fotosubida->getClientOriginalExtension();
				}


				/* establecer estado de anuncio a desactivado (creado)
				   si edita anuncio activo debe solicitar nuevamente publicación	
				*/
				$anuncio->estado_id = 2;


				if ($manageranuncio->simpleSave())
				{
					

					$manageranunciante->save();
					/*return \Redirect::route('misanuncios')->with('status_ok',
																 'Su anuncio fue editado correctamente'); */

					return \Redirect::route('mostrar.solicitud.publicacion',[$anuncio->id ]); 
					
				}
			}

			return \Redirect::back()->withInput()->withErrors($manageranunciante->getErrores());	
		}
			
		return \Redirect::back()->withInput()->withErrors($manageranuncio->getErrores());
	}

	public function editarServicio()
	{
		$anuncio = $this->anuncioRepo->buscarAnuncioId(\Input::only('anuncio')['anuncio']);
		$anunciante = $anuncio->anunciante;
		$manageranunciante = new AnuncianteManager($anunciante, \Input::all());
		$manageranuncio = new ServicioManager($anuncio, \Input::all());

		if($manageranuncio->isValid())
		{
			if($manageranunciante->isValid())
			{
				$anuncio->descripcion = \Helper::purificarCadena(\Input::get('descripcion'));
				$anuncio->titulo = \Helper::purificarCadena(\Input::get('titulo'));
				$anuncio->direccion = \Helper::purificarCadena(\Input::get('direccion'));;

				$this->cambiarEstadoADesactivado($anuncio);
				
				$manageranuncio->save();

				/*ruta del directorio pincipal donde se guardarán las fotos subidas por usuarios sobre sus anuncios*/
				$directorio = public_path().'/uploads/';

				$carpetaanuncio = $directorio.$anuncio->id.'/';
				
				if (\Input::hasFile('foto1'))
				{	
					/*Obtener datos del archivo subido temporalmente al servidor*/
					$fotosubida = \Input::file('foto1');
					$extension = $fotosubida->getClientOriginalExtension();
					
					$imagenController = new \imagenes\ImagenController();
					$imagenController->subirfotos($carpetaanuncio, $fotosubida, 1);

					$anuncio->foto1 = '/uploads/'.$anuncio->id.'/'.'mir_foto1'.'.'.$fotosubida->getClientOriginalExtension();

					/*resize imagen para miniatura*/
					$imagenMiniatura = $carpetaanuncio.'miniaturita'.'.'.$extension;
					$intImagen = \Image::make($imagenMiniatura)->resize(120, 120);
					
					$intImagen->save($imagenMiniatura);
					$anuncio->imagen = '/uploads/'.$anuncio->id.'/'.'miniaturita'.'.'.$extension;
				}
				
				if($manageranuncio->simpleSave())
				{
					$manageranunciante->save();
					return \Redirect::route('misanuncios')->with('status_ok',
																 'Su anuncio fue editado correctamente'); 
				}
			}
			
			return \Redirect::back()->withInput()->withErrors($manageranunciante->getErrores());	
		}
		
		return \Redirect::back()->withInput()->withErrors($manageranuncio->getErrores());
	}

	public function editarEmpleo()
	{
		$anuncio = $this->anuncioRepo->buscarAnuncioId(\Input::only('anuncio')['anuncio']);
		$anunciante = $anuncio->anunciante;
		
		$manageranunciante = new AnuncianteManager($anunciante, \Input::all());
		$manageranuncio = new EmpleoManager($anuncio, \Input::all());

		if($manageranuncio->isValid())
		{
			if($manageranunciante->isValid())
			{
				$anuncio->descripcion = \Helper::purificarCadena(\Input::get('descripcion'));
				$anuncio->titulo = \Helper::purificarCadena(\Input::get('titulo'));

				$this->cambiarEstadoADesactivado($anuncio);
				
				if($manageranuncio->simpleSave())
				{
					$manageranunciante->save();
					return \Redirect::route('misanuncios')->with('status_ok',
																 'Su anuncio fue editado correctamente'); 
				}
			}
			
			return \Redirect::back()->withInput()->withErrors($manageranunciante->getErrores());	
		}
		
		return \Redirect::back()->withInput()->withErrors($manageranuncio->getErrores());
	}

	/** 
	*	Cambia estado de rechazado a desactivado 
	*   para que el anuncio pueda ser enviado nuevamente con solicitud de publicacion
	*
	*/
	public function cambiarEstadoADesactivado($anuncio){
		if ($anuncio->estado_id == 7)
		{
			$anuncio->estado_id = 2;
		}
	}
}
