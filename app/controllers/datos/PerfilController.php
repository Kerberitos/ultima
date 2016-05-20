<?php namespace datos;

use Anuncia\Managers\FotoManager;

use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\ConfiguracionRepo;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Visualizar el perfil de usuario
 *		- Modificar foto de perfil
 * ----------------------------------------------------
 * Rutas:
 *
 *		- miradita/app/routes/auth.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class PerfilController extends \BaseController
{
	protected $usuarioRepo;
	protected $configuracionRepo;
	
	public function __construct(UsuarioRepo $usuarioRepo,
								ConfiguracionRepo $configuracionRepo)
	{
		$this->usuarioRepo = $usuarioRepo;
		$this->configuracionRepo = $configuracionRepo;
	}

	/* Muestra perfil de usuario */
	public function getPerfil($slug)
	{
		$cuenta = \Auth::user();
		$usuario = \Auth::user()->usuario;
		
		# configuración del sistema Miradita
		$configuracion = $this->configuracionRepo->cargarConfiguracionActual();

		return \View::make('modulos.datos.perfil', 
							compact('cuenta', 'usuario', 'configuracion')
				);
	}

	/* Muestra formulario para editar foto */
	public function getEditarFoto($slug)
	{
		$usuario = \Auth::user();
		
		return \View::make('modulos.datos.editarfoto', 
							compact('usuario')
				);
	}

	/* Cambia foto de perfil */
	public function postEditarFoto($slug)
	{
		try
		{
			\DB::beginTransaction();

			$usuarioId = \Auth::user()->id;
			
			$usuario = $this->usuarioRepo->buscarUsuario($usuarioId);

			$manager = new FotoManager($usuario, \Input::all());	
			
			/* Si existe foto cargada se realiza el proceso */
			if (\Input::hasFile('fotoperfil'))
			{
				// Si la foto pasa las validaciones
				if ($manager->isValid())
				{
					# ruta del directorio donde se guardará la foto de perfil
					$ruta = public_path().'/profile/';

					// Si no existe el directorio, se crea con los correspondientes permisos
					if (!is_dir($ruta))
					{
						mkdir($ruta, 0777, true);
					}
					
					// Obtener datos del archivo subido temporalmente al servidor
					$fototemporal = \Input::file('fotoperfil');

					// El nombre de la foto estará dado por el id de usuario
					$nombre = $usuario->id;
					
					// asignar el nombre y la respectiva extension (jpg, jpeg, png)
					$nombreFinal = $nombre.'.'.$fototemporal->getClientOriginalExtension();
					
					// Ruta que se guardará en la base de datos
					$usuario->foto = '/profile/'.'prof_'.$nombreFinal;

					// guardamos la ruta en la bd
					if ($manager->save())
					{
						// Subir la foto al servidor
						if ($fototemporal->move($ruta, 'prof_'.$nombreFinal))
						{
							$intImagen = \Image::make($ruta.'prof_'.$nombreFinal)->resize(200, 200);
							
							$intImagen->save($ruta.'prof_'.$nombreFinal);

							\DB::commit();
							
							return \Redirect::route('perfil',[$usuario->slug ]);
						}
						// si la foto no puede ser subida al servidor
						return \Redirect::back()->with('status_error', 
													   'Lo sentimos mucho, pero no 
													    hemos podido subir tu foto,
													    inténtalo más tarde.');
					}
					// si no puede guardarse la ruta de la foto de perfil
					return \Redirect::back()->with('status_error', 
													   'Lo sentimos mucho, pero no 
													    hemos podido guardar tu foto.');
				}
				// si la foto no pasa las validaciones
				return \Redirect::back()->withInput()->withErrors($manager->getErrores());
			}
			// si no se cargó nueva foto para cambiar simplemente redireccionar a perfil
			return \Redirect::route('perfil',[$usuario->slug]);
		}
		catch(\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}
	}

}

