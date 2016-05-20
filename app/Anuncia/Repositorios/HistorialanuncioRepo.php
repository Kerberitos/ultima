<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Historialanuncio;

class HistorialanuncioRepo extends BaseRepo
{

	public function getModel()
	{
		return new Historialanuncio;	
	}
	
	/* Crea un nuevo historial de anuncio */	
	public function nuevoHistorialAnuncio($anuncio_id)
	{
		$historial = new Historialanuncio();
		$historial->anuncio_id = $anuncio_id;
		
		return $historial;
	}

	/* Guarda el historial de anuncio */
	public function guardar()
	{
		$this->save();
	}

	public function cargarHistorialAnuncio($anuncio_id)
	{

		$historialAnuncio = Historialanuncio::where('anuncio_id','=', $anuncio_id)->get();
		return $historialAnuncio;
	}


	public function cargarUltimaHistoria($anuncio_id)
	{

		$historialAnuncio = $this->cargarHistorialAnuncio($anuncio_id);
		$ultimaHistoria = $historialAnuncio->last();
	
		return $ultimaHistoria;
	}

}