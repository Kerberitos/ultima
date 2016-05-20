<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Categoria;

class CategoriaRepo extends BaseRepo
{
	public function getModel()
	{
		return new Categoria;	
	}
	
	/* Busca categoría por id */
	public function buscarCategoria($id)
	{
		$categoria = Categoria::find($id);
		
		return $categoria;
	}






	public function buscar_categorias_clasificados()
	{
		$categorias=Categoria::where('seccion_id','=', 1)->get();
		
		return $categorias;
	}
	
	public function buscar_categorias_servicios()
	{
		$categorias=Categoria::where('seccion_id','=', 2)->get();
		
		return $categorias;
	}
	
	public function buscar_categorias_empleos()
	{
		$categorias=Categoria::where('seccion_id','=', 3)->get();
		
		return $categorias;
	}
}
