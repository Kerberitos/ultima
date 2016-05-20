<?php namespace anuncios;

use Illuminate\Support\Facades\Redirect;

use Anuncia\Entidades\Categoria;
use Anuncia\Entidades\Subcategoria;
use Anuncia\Entidades\Pregunta;
use Anuncia\Entidades\Anuncio;

use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\AnuncianteRepo;
use Anuncia\Repositorios\CategoriaRepo;
use Anuncia\Repositorios\SubcategoriaRepo;
use Anuncia\Repositorios\PreguntaRepo;
use Anuncia\Repositorios\ConfiguracionRepo;

use Anuncia\Managers\ClasificadoManager;
use Anuncia\Managers\ServicioManager;
use Anuncia\Managers\EmpleoManager;
use Anuncia\Managers\AnuncianteManager;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Crear anuncios
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

class CreacionAnuncioController extends \BaseController
{
	protected $anuncioRepo;
	protected $anuncianteRepo;
	protected $categoriaRepo;
	protected $subcategoriaRepo;
	protected $preguntaRepo;
	protected $configuracionRepo;

	public function __construct(AnuncioRepo $anuncioRepo, 
								AnuncianteRepo $anuncianteRepo,
								CategoriaRepo $categoriaRepo,
								SubcategoriaRepo $subcategoriaRepo,
								PreguntaRepo $preguntaRepo,
								ConfiguracionRepo $configuracionRepo)
	{
		$this->anuncioRepo = $anuncioRepo;
		$this->anuncianteRepo = $anuncianteRepo;
		$this->categoriaRepo = $categoriaRepo;
		$this->subcategoriaRepo = $subcategoriaRepo;
		$this->preguntaRepo = $preguntaRepo;
		$this->configuracionRepo = $configuracionRepo;
	}

	/* Muestra el primer paso para crear anuncio */
	public function mostrarPasoUno()
	{
		$cuenta = \Auth::user();

		$usuario = $cuenta->usuario;

		# configuración del sistema
		$configuracion = $this->configuracionRepo->cargarConfiguracionActual();
		# anuncios creados por el usuario
		$anunciosCreados = $usuario->anuncios->count();
		# rol del usuario
		$rolUsuario = $usuario->rol_id;

		if ($rolUsuario == 1)
		{
			# anuncios que el sistema permite crear a un usuario
			$anunciosPermitidos = $configuracion->anunciosusuario;
		}
		else if ($rolUsuario == 2 | $rolUsuario == 3)
		{
			# anuncios que el sistema permite crear a un administrador
			$anunciosPermitidos = $configuracion->anunciosadministrador;
		}

		// Los anuncios creados por el usuario no deben exceder los permitidos por el sistema
		if ($anunciosCreados < $anunciosPermitidos)
		{
			return \View::make('modulos.anuncios.crear.primerpaso');
		}
		
		return \Redirect::route('misanuncios')->with('status_limitedeanuncios',
														 'No puede crear más anuncios, usted ha 
														  llegado al límite de '.$anunciosPermitidos.
														 ' anuncios permitidos.');
	}

	/*Devuelve las categorias mediante ajax*/
	public function categorias()
	{
  	  	$seccion_id = e(\Input::get('seccion2'));
 	  	
		return Categoria::where('seccion_id','=', $seccion_id)->get();
	}

	/*Devuelve las subcategorias mediante ajax*/
	public function subcategorias()
	{
		$categoria_id = e(\Input::get('categoria'));

		return Subcategoria::where('categoria_id','=', $categoria_id)->get();

	}
	
	/*Devuelve las preguntas ¿qué deseaa hacer? mediante ajax*/
	public function opcion()
	{
		$seccion_id =e(\Input::get('seccion'));

		return Pregunta::where('seccion_id','=', $seccion_id)->get();
	}

	/* Envía datos desde paso uno para mostrar correspondiente formulario de crear anuncio */
	public function enviarPasoUno()
	{
		$seccion_id = \Input::get('seccion_id');
		$categoria = \Input::get('categoria');
		$subcategoria = \Input::get('subcategoria');
		$opcion = \Input::get('opcion');
		
		if ($seccion_id == 1)
		{
			$seccion = "clasificados";
		}
		else if ($seccion_id == 2)
		{
			$seccion = "servicios";
		}else if ($seccion_id == 3)
		{
			$seccion = "empleos";
		}
		return \Redirect::route('mostrar.formulario',[ $seccion, $categoria, $subcategoria, $opcion ]);
	}

	/* Muestra formulario crear anuncio */
	public function mostrarFormulario($seccion, $categoria_id, $subcategoria_id, $pregunta_id)
	{
		$categoria = $this->categoriaRepo->buscarCategoria($categoria_id);
		$this->notFoundUnLess($categoria);
		
		$subcategoria = $this->subcategoriaRepo->buscarSubcategoria($subcategoria_id);
		$this->notFoundUnLess($subcategoria);
		
		$pregunta = $this->preguntaRepo->buscarPregunta($pregunta_id);
		$this->notFoundUnLess($pregunta);
		
		# carga usuario que inició sesión 
		$usuario = \Auth::user()->usuario;

		if (\Helper::compararCadenas($seccion, "clasificados"))
		{
			/*Evita que usuarios modifiquen los ids manualmente en el navegador*/
			if (($categoria->seccion_id == 1) & ($subcategoria->categoria_id == $categoria->id) & ($pregunta->seccion_id == 1))
			{
				return \View::make('modulos.anuncios.crear.clasificado', 
									compact('categoria','subcategoria', 'pregunta', 'usuario')
						);
			}
			return	\App::abort(404);
		}
		else if (\Helper::compararCadenas($seccion, "servicios"))
		{
			if (($categoria->seccion_id == 2) & ($subcategoria->categoria_id == $categoria->id) & ($pregunta->seccion_id == 2))
			{
				return \View::make('modulos.anuncios.crear.servicio', 
									compact('categoria','subcategoria', 'pregunta', 'usuario')
						);
			}
			return	\App::abort(404);
		}
		else if (\Helper::compararCadenas($seccion, "empleos"))
		{
			if (($categoria->seccion_id == 3) & ($subcategoria->categoria_id == $categoria->id) & ($pregunta->seccion_id == 3))
			{
				return \View::make('modulos.anuncios.crear.empleo', 
									compact('categoria','subcategoria', 'pregunta', 'usuario')
						);
			}
			return	\App::abort(404);
		}
		return	\App::abort(404);
	}
	
	/* Procesa formulario crear clasificado, guarda anuncio clasificado */
	public function postClasificado()
	{
		

		$usuarioId = \Auth::user()->usuario->id;

		$anunciante = $this->anuncianteRepo->nuevoAnunciante();
		$manageranunciante = new AnuncianteManager($anunciante, \Input::all());

		
		

		$anuncio = $this->anuncioRepo->newAnuncio($usuarioId);
		$manageranuncio = new ClasificadoManager($anuncio, \Input::all());






		if ($manageranuncio->isValid())
		{
			if ($manageranunciante->isValid())
			{
				try
				{
					\DB::beginTransaction();	

					$anuncio->titulo = \Helper::purificarCadena(\Input::get('titulo'));
					$anuncio->descripcion = \Helper::purificarCadena(\Input::get('descripcion'));

					# obtiene solo las palabras
					$anuncio->palabras_claves = $this->reemplazarCaracteres( \Input::get('palabras_claves'));
					$manageranuncio->save();
					
					# ruta del directorio pincipal donde se guardarán las fotos subidas por usuarios sobre sus anuncios
					$directorio = public_path().'/uploads/';
					# dentro del directorio pricipal se creará un directorio para cada anuncio 
					$carpetaanuncio = $directorio.$anuncio->id.'/';


							


					/* Sube foto principal del anuncio */
					if (\Input::hasFile('foto1'))
					{	
						/*Obtener datos del archivo subido temporalmente al servidor*/
						$fotosubida = \Input::file('foto1');
						$extension = $fotosubida->getClientOriginalExtension();
												
						$imagenController = new \imagenes\ImagenController();
						$imagenController->subirfotos($carpetaanuncio, $fotosubida, 1);
						# almacena la ruta donde se almacenará la foto principal
						$anuncio->foto1 = '/uploads/'.$anuncio->id.'/'.'mir_foto1'.'.'.$fotosubida->getClientOriginalExtension();

						/* Crea miniatura de la imagen principal del anuncio */
						$imagenMiniatura = $carpetaanuncio.'miniaturita'.'.'.$extension;
						$intImagen = \Image::make($imagenMiniatura)->resize(120, 120);
						$intImagen->save($imagenMiniatura);
						$anuncio->imagen = '/uploads/'.$anuncio->id.'/'.'miniaturita'.'.'.$extension;
					}

					/* Sube foto 2 del anuncio */
					if (\Input::hasFile('foto2'))
					{	
						$fotosubida=\Input::file('foto2');
						
						$imagenController = new \imagenes\ImagenController();
						$imagenController->subirfotos($carpetaanuncio, $fotosubida, 2);
						# almacena la ruta donde se almacenará la foto 2
						$anuncio->foto2 = '/uploads/'.$anuncio->id.'/'.'mir_foto2'.'.'.$fotosubida->getClientOriginalExtension();
					}

					if (\Input::hasFile('foto3'))
					{	
						$fotosubida = \Input::file('foto3');
						
						$imagenController = new \imagenes\ImagenController();
						$imagenController->subirfotos($carpetaanuncio, $fotosubida, 3);
						# almacena la ruta donde se almacenará la foto 3
						$anuncio->foto3 = '/uploads/'.$anuncio->id.'/'.'mir_foto3'.'.'.$fotosubida->getClientOriginalExtension();
					}

					if (\Input::hasFile('foto4'))
					{	
						$fotosubida = \Input::file('foto4');
						
						$imagenController = new \imagenes\ImagenController();
						$imagenController->subirfotos($carpetaanuncio, $fotosubida, 4);
						# almacena la ruta donde se almacenará la foto 4
						$anuncio->foto4 = '/uploads/'.$anuncio->id.'/'.'mir_foto4'.'.'.$fotosubida->getClientOriginalExtension();
					}
					
					//dd('nedrra');


					if ($manageranuncio->simpleSave())
					{
						/* vincula anuncio con anunciante */	
						$anunciante->anuncio_id = $anuncio->id;
						$manageranunciante->save();

						\DB::commit();

						return \Redirect::route('mostrar.solicitud.publicacion',[$anuncio->id ]); 
					}
				}
				catch(\Exception $ex)
				{
					\DB::rollback();
					\Session::flash('error_de_servidor',1);
					return \Redirect::back();
				}
			}
			return \Redirect::back()->withInput()->withErrors($manageranunciante->getErrores());	
		}
		return \Redirect::back()->withInput()->withErrors($manageranuncio->getErrores());
	}

	/* Procesa formulario crear servicio, guarda anuncio sobre servicio */
	public function postServicio()
	{
		$usuarioId = \Auth::user()->usuario->id;

		$anunciante = $this->anuncianteRepo->nuevoAnunciante();
		$manageranunciante = new AnuncianteManager($anunciante, \Input::all());

		$anuncio = $this->anuncioRepo->newAnuncio($usuarioId);
		$manageranuncio = new ServicioManager($anuncio, \Input::all());

		if($manageranuncio->isValid())
		{
			if($manageranunciante->isValid())
			{
				try
				{
					\DB::beginTransaction();	

					$anuncio->descripcion = \Helper::purificarCadena(\Input::get('descripcion'));
					$anuncio->titulo = \Helper::purificarCadena(\Input::get('titulo'));
					$anuncio->direccion=\Helper::purificarCadena(\Input::get('direccion'));;
					$anuncio->palabras_claves=$this->reemplazarCaracteres( \Input::get('palabras_claves'));
					$manageranuncio->save();
					/*ruta del directorio pincipal donde se guardarán las fotos subidas por usuarios sobre sus anuncios*/
					$directorio=public_path().'/uploads/';
					$carpetaanuncio=$directorio.$anuncio->id.'/';
				
					if (\Input::hasFile('foto1'))
					{	
						/*Obtener datos del archivo subido temporalmente al servidor*/
						$fotosubida = \Input::file('foto1');
						$extension = $fotosubida->getClientOriginalExtension();
						
						$imagenController = new \imagenes\ImagenController();
						$imagenController->subirfotos($carpetaanuncio, $fotosubida, 1);
						# almacena la ruta donde se almacenará la foto de servicio
						$anuncio->foto1='/uploads/'.$anuncio->id.'/'.'mir_foto1'.'.'.$fotosubida->getClientOriginalExtension();

						/* Crea miniatura de la imagen del anuncio sobre servicio*/
						$imagenMiniatura= $carpetaanuncio.'miniaturita'.'.'.$extension;
						$intImagen= \Image::make($imagenMiniatura)->resize(120, 120);
						$intImagen->save($imagenMiniatura);
						$anuncio->imagen='/uploads/'.$anuncio->id.'/'.'miniaturita'.'.'.$extension;
					}
			
					if ($manageranuncio->simpleSave())
					{
						/* vincula anuncio con anunciante */	
						$anunciante->anuncio_id=$anuncio->id;
						$manageranunciante->save();

						\DB::commit();

						return \Redirect::route('mostrar.solicitud.publicacion',[$anuncio->id ]); 
					}
				}
				catch(\Exception $ex)
				{
					\DB::rollback();
					\Session::flash('error_de_servidor',1);
					return \Redirect::back();
				}	
			}
			return \Redirect::back()->withInput()->withErrors($manageranunciante->getErrores());	
		}
		return \Redirect::back()->withInput()->withErrors($manageranuncio->getErrores());
	}

	/* Procesa formulario crear empleo, guarda anuncio sobre empleo */
	public function postEmpleo()
	{
		$usuarioId = \Auth::user()->usuario->id;

		$anunciante = $this->anuncianteRepo->nuevoAnunciante();
		$manageranunciante = new AnuncianteManager($anunciante, \Input::all());


		$anuncio = $this->anuncioRepo->newAnuncio($usuarioId);
		$manageranuncio = new EmpleoManager($anuncio, \Input::all());

		if($manageranuncio->isValid())
		{
			if($manageranunciante->isValid())
			{
				try
				{
					\DB::beginTransaction();	

					$anuncio->descripcion = \Helper::purificarCadena(\Input::get('descripcion'));
					$anuncio->titulo = \Helper::purificarCadena(\Input::get('titulo'));
					
					$anuncio->palabras_claves = $this->reemplazarCaracteres( \Input::get('palabras_claves'));
					$manageranuncio->save();
					/* vincula anuncio con anunciante */			
					$anunciante->anuncio_id = $anuncio->id;
					$manageranunciante->save();
					
					\DB::commit();

					return \Redirect::route('mostrar.solicitud.publicacion',[$anuncio->id ]); 
				}
				catch(\Exception $ex)
				{
					\DB::rollback();
					\Session::flash('error_de_servidor',1);
					return \Redirect::back();
				}
			}
			return \Redirect::back()->withInput()->withErrors($manageranunciante->getErrores());	
		}
		return \Redirect::back()->withInput()->withErrors($manageranuncio->getErrores());
	}

	/* Deja solo las palabras claves que vienen de las categorias y subcategorias */
	public function reemplazarCaracteres($cadena)
	{
		$caracteresReemplazar = array(' de ',' para ', ' o ', ' u ',' e ',' en ', ' al ', ' por ', ' y ', ',');
		$caracteresFinales = array(' , ' , ' , ' , ' , ' ,' , ', ' , ' , ' , ' , ' , ', ' , '  , ' , '  , ' ');
		# reemplaza  en una cadena determinados caracteres por una coma
		$palabras = str_replace($caracteresReemplazar, $caracteresFinales, $cadena);

		return $palabras;
	}
}
