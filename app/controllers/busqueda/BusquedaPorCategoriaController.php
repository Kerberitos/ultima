<?php namespace busqueda;

use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\CategoriaRepo;
use Anuncia\Repositorios\SubcategoriaRepo;

class BusquedaPorCategoriaController extends \BaseController
{
	protected $anuncioRepo;
	protected $categoriaRepo;
	protected $subcategoriaRepo;
	
	public function __construct(AnuncioRepo $anuncioRepo,
								CategoriaRepo $categoriaRepo,
								SubcategoriaRepo $subcategoriaRepo)
	{
		$this->anuncioRepo = $anuncioRepo;
		$this->categoriaRepo = $categoriaRepo;
		$this->subcategoriaRepo = $subcategoriaRepo;
	}

	/* Muestra anuncios clasificados por categoria seleccionada */
	public function buscarClasificadosCategoriaN($categoria_id)
	{
		$anuncios = $this->anuncioRepo->clasificadosCategoriaN($categoria_id);
		
		$categoria = $this->categoriaRepo->buscarCategoria($categoria_id);

		if ($categoria->seccion_id == 1)
		{
			return \View::make('modulos.busqueda.porcategorias.clasificadoscategorian', 
								compact('anuncios','categoria')
					);	
		}

		return \App::abort(404);
	}

	/* Muestra anuncios servicios por categoria seleccionada */
	public function buscarServiciosCategoriaN($categoria_id)
	{
		$anuncios = $this->anuncioRepo->serviciosCategoriaN($categoria_id);
		
		$categoria = $this->categoriaRepo->buscarCategoria($categoria_id);

		if ($categoria->seccion_id == 2)
		{
			return \View::make('modulos.busqueda.porcategorias.servicioscategorian', 
								compact('anuncios','categoria')
					);	
		}

		return	\App::abort(404);
	}

	/* Muestra anuncios empleos por categoria seleccionada */
	public function buscarEmpleosCategoriaN($categoria_id)
	{
		$anuncios = $this->anuncioRepo->empleosCategoriaN($categoria_id);
		
		$categoria = $this->categoriaRepo->buscarCategoria($categoria_id);

		if ($categoria->seccion_id == 3)
		{
			return \View::make('modulos.busqueda.porcategorias.empleoscategorian', 
								compact('anuncios','categoria')
					);	
		}
		return	\App::abort(404);
	}
	
}
