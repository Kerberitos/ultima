<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Agenda;

class AgendaRepo extends BaseRepo
{
	
	public function getModel()
	{
		return new Agenda;	
	}
	
	public function nuevaAgenda($usuario_id)
	{
		$agenda = new Agenda();
		$agenda->usuario_id = $usuario_id;
		
		return $agenda;
	}

	/* Busca todos los contactos de agenda */
	public function cargarAgenda($usuario_id)
	{
		return Agenda::where('usuario_id','=', $usuario_id)->orderBy('nombre', 'asc')->paginate(12);
	}

	/* Busca contacto de agenda por id*/
	public function buscarContactoId($contacto_id)
	{
		return Agenda::find($contacto_id);
	}

	/* Busca contacto de agenda por id */
	public function buscarContactoPorAnunciante($anunciante_id)
	{
		return Agenda::where('anunciante_id','=', $anunciante_id)->first();
	}

	/* Devuelve los contactos de agenda buscando por sus nombres */
	public function busquedaContactosPorNombres($busqueda, $usuario_id)
	{
		return  Agenda::where('usuario_id', '=', $usuario_id)->where(function($query) use($busqueda) {
                $query->where('nombre', 'like', '%'.$busqueda.'%');
            	})->paginate(12);	
	}

	/* Elimina contacto de agenda*/
	public function eliminarContacto($contacto)
	{
		if($contacto->delete())
		{
			return true;	
		}
		
		return false;
	}


}
