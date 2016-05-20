<?php namespace busqueda;

use Anuncia\Repositorios\AnuncioRepo;

class BusquedaAnuncioController extends \BaseController
{
	protected $anuncioRepo;
	
	public function __construct(AnuncioRepo $anuncioRepo)
	{
		$this->anuncioRepo = $anuncioRepo;
	}

	/* Busca anuncios mediante palabras claves (busqueda full-text)*/
	public function busquedaDeAnuncios()
	{

		$busqueda = \Helper::purificarCadena(\Input::get('busqueda'));

		$seccion = (int) \Input::get('seccion');

		$seccionseleccionada = 0;
		$textobuscado = "";

		if ($seccion == 0)
		{
			$seccionseleccionada = "Todas las secciones";
		}
		if ($seccion == 1)
		{
			$seccionseleccionada = "Clasificados";
		}
		else if ($seccion == 2)
		{
			$seccionseleccionada = "Servicios";
		}
		else if ($seccion == 3)
		{
			$seccionseleccionada = "Empleos";
		}

		// No se ingresó nada en el campo de busqueda y no se seleccionó sección
		if ($busqueda == "" & $seccion == 0)
		{
			// Si no se escribe nada en el campo de busqueda ni se seleccionó ninguna opción del select
			// entonces no se realiza ninguna acción
		}
		// Si se ingresó texto en el campo de búsqueda
		else if ($busqueda != "")
		{
			$textobuscado = $busqueda;
			
			$resultados =$this->anuncioRepo->busquedaFulltext($seccion, $busqueda);
			
			// Si no hay resusltados de buqueda
			# sizeof devuelve el tamaño del array
			if (sizeof($resultados) == 0)
			{
				return \Redirect::route('busqueda')->with('status_nohaycoincidencias',
														  'No hay resultados de búsqueda 
														   para '.$textobuscado);
			}
			// Si hay resultados
			return \View::make('modulos.busqueda.buscar', 
								compact('resultados','textobuscado', 'seccionseleccionada','seccion')
					);
		}
		// No se ingresó texto pero si se seleccionó sección
		else if ($busqueda == "" & $seccion != 0)
		{
			$resultados = $this->anuncioRepo->busquedaAnunciosPorSeccion($seccion);
			
			if(sizeof($resultados)==0)
			{
				return \Redirect::route('busqueda')->with('status_nohaycoincidencias',
													      'No hay resultados de búsqueda');
			}
			
			return \View::make('modulos.busqueda.buscar', 
									compact('resultados','textobuscado', 'seccionseleccionada','seccion')
					);
		}
		
		// Cuando se llama a Busqueda por defecto no se carga ningún anuncio
		$resultados = $this->anuncioRepo->anuncioVacio();

		return \View::make('modulos.busqueda.buscar', 
							compact('resultados','textobuscado', 'seccionseleccionada','seccion')
				);
	}

}