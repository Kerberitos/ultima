<?php

use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\CategoriaRepo;

/**
 * ----------------------------------------------------
 * Clase que permite:
 *		- Ver la página inicial
 * 		
 *		
 * 
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class MainController extends BaseController
{
	protected $anuncioRepo;
	protected $categoriaRepo;

	public function __construct(AnuncioRepo $anuncioRepo,
								CategoriaRepo $categoriaRepo)
	{
		$this->anuncioRepo = $anuncioRepo;
		$this->categoriaRepo = $categoriaRepo;
	}


	/* Muestra la página de inicio de la aplicación */
	public function getMain()
	{
		return \View::make('main');
	}

	/* Muestra todos los anuncios Clasificados */
	public function verAnunciosClasificados()
	{
		

		$anuncios = $this->anuncioRepo->buscar_anuncios_clasificados();
		
		

		return \View::make('modulos.anuncios.clasificados', 
						   compact('anuncios')
				);
	}

	/* Muestra todos los anuncios sobre Servicios */
	public function verAnunciosServicios()
	{
		$anuncios = $this->anuncioRepo->buscar_anuncios_servicios();
		
		return \View::make('modulos.anuncios.servicios', 
						   compact('anuncios')
				);
	}
	
	/* Muestra todos los anuncios sobre Empleos */
	public function verAnunciosEmpleos()
	{
		$anuncios = $this->anuncioRepo->buscar_anuncios_empleos();
		
		return  \View::make('modulos.anuncios.empleos', 
						   compact('anuncios')
				);
	}

	/* Muestra todas las categorías de Clasificados */
	public function verCategoriasDeClasificados()
	{
		$categorias = $this->categoriaRepo->buscar_categorias_clasificados();
		
		return \View::make('modulos.anuncios.ver.porcategorias.categoriasclasificados', 
						   compact('categorias')
				);
	}
	
	/* Muestra todas las categorías de Servicios */
	public function verCategoriasDeServicios()
	{
		$categorias = $this->categoriaRepo->buscar_categorias_servicios();
		
		return \View::make('modulos.anuncios.ver.porcategorias.categoriasservicios', 
							compact('categorias')
				);
	}
	
	/* Muestra todas las categorías de Empleos */
	public function verCategoriasDeEmpleos()
	{
		$categorias = $this->categoriaRepo->buscar_categorias_empleos();
		
		return \View::make('modulos.anuncios.ver.porcategorias.categoriasempleos', 
							compact('categorias')
				);
	}

}
