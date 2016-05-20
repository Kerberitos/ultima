<?php namespace busqueda;

use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\CategoriaRepo;
use Anuncia\Repositorios\SubcategoriaRepo;

class BusquedaPorSubcategoriaController extends \BaseController
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

	/* Muestra anuncios clasificados por subcategoria seleccionada */
	public function buscarClasificadosSubcategoriaN($categoria_id, $subcategoria_id)
	{
		$anuncios = $this->anuncioRepo->anunciosSubcategoriaN($subcategoria_id);
		
		$subcategoria = $this->subcategoriaRepo->buscarSubcategoria($subcategoria_id);
		$categoria = $this->categoriaRepo->buscarCategoria($categoria_id);

		$this->notFoundUnLess($subcategoria);
		$this->notFoundUnLess($categoria);

		if ($categoria->seccion_id == 1 & $subcategoria->categoria_id == $categoria->id )
		{
			return \View::make('modulos.busqueda.porsubcategorias.clasificadossubcategorian', 
								compact('anuncios', 'subcategoria', 'categoria')
			);	
		}
		return	\App::abort(404);
	}

	/* Muestra anuncios sobre servicios por subcategoria seleccionada */
	public function buscarServiciosSubcategoriaN($categoria_id, $subcategoria_id)
	{
		
		$anuncios = $this->anuncioRepo->anunciosSubcategoriaN($subcategoria_id);
		
		$subcategoria = $this->subcategoriaRepo->buscarSubcategoria($subcategoria_id);
		$categoria = $this->categoriaRepo->buscarCategoria($categoria_id);

		$this->notFoundUnLess($subcategoria);
		$this->notFoundUnLess($categoria);

		if ($categoria->seccion_id == 2 & $subcategoria->categoria_id == $categoria->id )
		{
			return \View::make('modulos.busqueda.porsubcategorias.serviciossubcategorian', 
								compact('anuncios', 'subcategoria', 'categoria')
					);	
		}
		
		return	\App::abort(404);
	}

	/* Muestra anuncios sobre empleos por subcategoria seleccionada */
	public function buscarEmpleosSubcategoriaN($categoria_id, $subcategoria_id)
	{
		$anuncios = $this->anuncioRepo->anunciosSubcategoriaN($subcategoria_id);
		
		$subcategoria = $this->subcategoriaRepo->buscarSubcategoria($subcategoria_id);
		$categoria = $this->categoriaRepo->buscarCategoria($categoria_id);

		$this->notFoundUnLess($subcategoria);
		$this->notFoundUnLess($categoria);


		if ($categoria->seccion_id == 3 & $subcategoria->categoria_id == $categoria->id )
		{
			return \View::make('modulos.busqueda.porsubcategorias.empleossubcategorian', 
								compact('anuncios','subcategoria', 'categoria')
					);	
		}
		
		return	\App::abort(404);
	}

}
