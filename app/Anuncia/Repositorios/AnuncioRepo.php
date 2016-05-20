<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Anuncio;
use Carbon\Carbon;
use Jenssegers\Date\Date;
class AnuncioRepo extends BaseRepo
{
	public function getModel()
	{
		return new Anuncio;	
	}
	
	public function newAnuncio($usuario_id)
	{
		$anuncio = new Anuncio();
		/*Anuncio inicia con 2, anuncio creado pero aun no ha sido revisado por un admin*/
		$anuncio->estado_id = 2;
		$anuncio->estatus_revision = "libre";
		$anuncio->usuario_id = $usuario_id;
		$anuncio->publicaciondate = Date::now();
		
		return $anuncio;
	}



	/* *Devuelve el numero de anuncios que solicitaron ser publicados */
	public function enumerarAnunciosPorRevisar()
	{
		return Anuncio::where('estado_id','=', 5)->count();	
	}

	/* *Devuelve el numero de anuncios denunciados */
	public function enumerarAnunciosDenunciados()
	{
		return Anuncio::where('estado_id','=', 6)->count();	
	}

	/* *Devuelve el numero de anuncios que están ocupados por un administrador (en revisión) */
	public function enumerarAnunciosPendientes($usuarioId)
	{
		return Anuncio::where('estado_id','=', 5)->where('admin','=', $usuarioId)->count();	
	}

	/* *Devuelve el numero de anuncios bloqueados */
	public function enumerarAnunciosBloqueados()
	{
		return Anuncio::where('estado_id','=', 3)->count();	
	}

	/* *Devuelve el numero de anuncios denunciados que están ocupados por un administrador (en revisión por denuncia) */
	public function enumerarAnunciosDenunciadosPendientes($usuario_id)
	{
		return Anuncio::where('estado_id','=', 6)->where('admin','=', $usuario_id)->count();	
	}












	
	/* Busqueda de anuncios full text mediante seccion de anuncio y palabras claves*/
	public function busquedaFulltext($seccion_id, $q)
	{
		$terms = $q;

		if ($seccion_id == 0)
		{
			return Anuncio::where('estado_id', '=', 1)->whereRaw("MATCH (titulo, descripcion, palabras_claves) AGAINST ('{$terms}*' IN BOOLEAN MODE)")->paginate(3);	 	
		}
		else
		{
			return Anuncio::where('estado_id', '=', 1)->where('seccion_id', '=', $seccion_id)->whereRaw("MATCH (titulo, descripcion, palabras_claves) AGAINST ('{$terms}*' IN BOOLEAN MODE)")->paginate(3);	 	
		}
	 
		// Utilizando DB directamente
		// $anuncios= \DB::table('anuncios')->whereRaw("MATCH(titulo,descripcion) AGAINST(? IN BOOLEAN MODE)", array($q))->get(); 
		
		// una variacion pruebas
		// return Anuncio::where('estado_id', '=', 1)->where('seccion_id', '=', $seccion_id)->whereRaw("MATCH (titulo, descripcion, palabras_claves) AGAINST (? IN BOOLEAN MODE)", array($q))->paginate(9);

		// Solo hace busquedas exactas, se descarta
		// return $anuncios = Anuncio::where('estado_id', '=', 1)->where('seccion_id', '=', $seccion_id)->whereRaw("match (titulo, descripcion, palabras_claves) against (? IN BOOLEAN MODE)", array($terms))->paginate(6);
	}


	public function busquedaSimple($seccion_id, $q)
	{
		$busqueda = $q;
		
		if ($seccion_id == 0)
		{

		$anuncios = \DB::table('anuncios')->where('estado_id', '=', 1)->where(function($query) use($busqueda) {
                $query->where('titulo', 'like', '%'.$busqueda.'%')->orWhere('descripcion', 'like', '%'.$busqueda.'%');
            })->get();	
		return $anuncios;
		}
		else
		{
			$anuncios = \DB::table('anuncios')->where('estado_id', '=', 1)->where('seccion_id', '=', $seccion_id)->where(function($query) use($busqueda) {
                $query->where('titulo', 'like', '%'.$busqueda.'%')->orWhere('descripcion', 'like', '%'.$busqueda.'%');
            })->get();
			return $anuncios;
		}	
	}

	public function buscar_anuncios_clasificados()
	{
		return Anuncio::where('seccion_id','=', 1)->where('estado_id','=', 1)->orderBy('publicaciondate', 'desc')->paginate(9);
	}
	
	public function buscar_anuncios_servicios()
	{
		return Anuncio::where('seccion_id','=', 2)->where('estado_id','=', 1)->orderBy('publicaciondate', 'desc')->paginate(9);
	}
	
	public function buscar_anuncios_empleos()
	{
		return Anuncio::where('seccion_id','=', 3)->where('estado_id','=', 1)->orderBy('publicaciondate', 'desc')->paginate(9);
	}


	/* Modifica el estado del anuncio cuando solicitan publicación de anuncio*/
	public function establecerEstadoDeRevision($anuncio_id)
	{
		$anuncio = Anuncio::find($anuncio_id);
		# estado de revisión es 5
		$anuncio->estado_id = 5;

		if ($anuncio->save())
		{
			return true;
		}
		return false;
	}

	/* Busca anuncios que pertenecen a un usuario, busqueda mediante id de usuario*/
	public function buscarAnunciosDeUsuario($usuario_id)
	{
		return Anuncio::where('usuario_id','=', $usuario_id)->orderBy('created_at', 'desc')->paginate(6);
	}

	/* Busca anuncio mediante su id */
	public function buscarAnuncioId($anuncio_id)
	{
		return $anuncio = Anuncio::find($anuncio_id);//Anuncio::where('id','=', $anuncio_id)->first();
	}

	/* Elimina anuncio mediante su id */
	public function eliminarAnuncio($id)
	{
		$anuncio = Anuncio::find($id);

		if($anuncio->delete())
		{
			return true;
		}

		return false;
	}

	/* Desactiva anuncio publicado */
	public function desactivarAnuncio($anuncio_id)
	{
		$anuncio = Anuncio::find($anuncio_id);

		# estado desactivado es 2
		$anuncio->estado_id = 2;

		$anuncio->publicaciondate = "";
		$anuncio->expiradate = "";
		
		if ($anuncio->save())
		{
			return true;
		}

		return false;
	}

	/* Establece el estado de denunciado a un anuncio */
	public function denunciarAnuncio($anuncio_id)
	{
		$anuncio=Anuncio::find($anuncio_id);

		# estado denunciado es 6
		$anuncio->estado_id = 6;
		
		if($anuncio->save())
		{
			return true;
		}
		return false;
	}

	/* Activa un anuncio, lo establece como estado de activado */
	public function activarAnuncio($anuncio_id)
	{
		$anuncio = Anuncio::find($anuncio_id);
		
		$anuncio->estado_id = 1;

		# estatus_revision permite conocer si el anuncio puede ser revisado
		# valores: libre u ocupado
		$anuncio->estatus_revision = "libre";
		# admin permite conocer el id del admin que revisa el anuncio
		$anuncio->admin = 0;
		
		/*establecer fecha de publicacion*/
		$anuncio->publicaciondate = Date::now();
		
		// dependiendo de la sección se establece la fecha de expiración de los anuncios
		# seccion_id 1 = clasificados | seccion_id 2 = servicios | seccion_id 3 = empleos
		if ($anuncio->seccion_id == 2)
		{
			// para anuncios sobre servicios un año de expiración, un año estará activo desde su publicación 
			$anuncio->expiradate=Date::now()->addYear();
		}
		else
		{
			// para anuncios clasificados y sobre empleos dos semanas de expiración, 
			// el anuncio estará activo dos semanas desde su publicación 
			$anuncio->expiradate=Date::now()->addWeeks(2);
		}
			
		if ($anuncio->save())
		{
			return true;
		}

		return false;
	}

	/* Establece el estado de rechazado a un anuncio */
	public function rechazarAnuncio($anuncio_id)
	{
		$anuncio = Anuncio::find($anuncio_id);
		
		# estado 7 equivalente a rechazado
		$anuncio->estado_id = 7;
		$anuncio->estatus_revision = "libre";
		$anuncio->admin = 0;
		
		if ($anuncio->save()) {
			return true;
		}
	}
	
	/* Establece el estado de bloqueado a un anuncio */
	public function bloquearAnuncio($anuncio_id, $admin)
	{
		$anuncio = Anuncio::find($anuncio_id);

		/*estado 3 equivalente a bloqueado*/
		$anuncio->estado_id = 3;
		$anuncio->estatus_revision = "libre";
		$anuncio->admin = $admin;
	
		if($anuncio->save()) {
			return true;
		}
	}

	/* Establece el estado de bloqueado a un anuncio */
	public function desbloquearAnuncio($anuncio_id, $admin)
	{
		$anuncio = Anuncio::find($anuncio_id);
		/*al desbloquear anuncio se establece como desactivado*/
		/*estado 2 equivalente a desactivado */
		$anuncio->estado_id = 2;
		$anuncio->estatus_revision = "libre";
		$anuncio->admin = $admin;
	
		if($anuncio->save()) {
			return true;
		}
	}



	/* Devuelve todos los anuncios que solicitaron ser publicados */
	public function buscarAnunciosPorPublicar()
	{
		# estado 5 equivalente a revision, que son los anuncios que solicitaron ser publicados
		$estadoanuncio = 5;
		
		return Anuncio::where('estado_id','=', 5)->paginate(16);
	}

	/* Devuelve todos los anuncios que solicitaron ser publicados que están siendo revisados por un administrador */
	public function buscarAnunciosPorPublicarPendientes($usuario_id)
	{
		# estado 5 equivalente a revision, que son los anuncios que solicitaron ser publicados
		$estadoanuncio = 5;
		return Anuncio::where('estado_id','=', 5)->where('admin','=', $usuario_id)->paginate(4);
	}

	/* Devuelve todos los anuncios denunciados */
	public function buscarAnunciosDenunciados()
	{
		# estado 6 equivalente a denunciado
		$estadoanuncio = 6;
		return Anuncio::where('estado_id','=', 6)->paginate(4);
	}

	/* Devuelve todos los anuncios bloqueados */
	public function buscarAnunciosBloqueados()
	{
		# estado 3 equivalente a bloqueado
		$estadoanuncio = 3;
		return Anuncio::where('estado_id','=', 3)->paginate(4);
	}


	/* Devuelve todos los anuncios denunciados pendientes*/
	public function buscarDenunciadosPendientes($admin_id)
	{
		# estado 6 equivalente a denunciado
		$estadoanuncio = 6;
		# admin_id es el id del administrador que está revisando el anuncio
		return Anuncio::where('estado_id','=', 6)->where('admin','=', $admin_id)->paginate(4);
	}

	/* Establece el estado de revision del anuncio como ocupado */
	public function estatusRevisionOcupado($anuncio, $admin)
	{
		$anuncio->estatus_revision = "ocupado";
		$anuncio->admin = $admin;
		$anuncio->save();
	}

	/* Reactiva y libera el anuncio */
	public function reactivarAnuncio($anuncio_id)
	{
		$anuncio = Anuncio::find($anuncio_id);
		/*estado 1 equivalente a activado*/
		$anuncio->estado_id = 1;
		$anuncio->estatus_revision = "libre";
		$anuncio->admin = 0;
		if($anuncio->save()) {
			return true;
		}
	}

	/* Carga anuncios expirados */
	public function anunciosExpirados()
	{
		# obtener fecha actual
		$fechahoy = Carbon::now()->toDateString();

		$anuncios = Anuncio::where('expiradate','<', $fechahoy)->where('estado_id','=',1)->get();
		
		return $anuncios;
	}	

	/* Enumera anuncios expirados*/
	public function enumerarAnunciosExpirados()
	{
		return $this->anunciosExpirados()->count();	
	}
	
	/* Desactiva anuncios expirados */
	public function desactivarExpirados($anuncios)
	{
		foreach ($anuncios as $anuncio)
		{
			$anuncio->estado_id = 2;
			$anuncio->save();
		}
		
		return true;
	}


	/* Carga anuncios ocupados */
	public function anunciosOcupados()
	{
		#estado 5 = revision
		$anuncios = Anuncio::where('estatus_revision','=', 'ocupado')->where('estado_id','=',5)->orWhere('estatus_revision','=', 'ocupado')->where('estado_id','=',6)->get();
		
		return $anuncios;
	}

	/* Enumera anuncios ocupados */
	public function enumerarAnunciosOcupados()
	{
		return $this->anunciosOcupados()->count();	
	}	

	/* Liberar anuncios ocupados */
	public function liberarOcupados($anuncios)
	{
		foreach ($anuncios as $anuncio)
		{
			$anuncio->estatus_revision = 'libre';
			$anuncio->admin = 0;

			$anuncio->save();
		}
		
		return true;
	}



	/* Obtiene un objeto vacio de tipo Anuncio */
	public function anuncioVacio()
	{
		return Anuncio::where('seccion_id','=', 5)->paginate(2);
	}

	/* Devuelve anuncios buscando mediante su seccion */
	public function busquedaAnunciosPorSeccion($seccion_id)
	{
		return Anuncio::where('seccion_id','=', $seccion_id)->where('estado_id','=', 1)->orderBy('publicaciondate', 'desc')->paginate(2);
	}


    /* Retorna anuncios clasificados activos y de categoria n..donde n= "categoria seleccionada por el usuario" */
	public function clasificadosCategoriaN($categoria_id)
	{
		return Anuncio::where('seccion_id','=', 1)->where('estado_id','=', 1)->where('categoria_id','=',$categoria_id)->orderBy('publicaciondate', 'desc')->paginate(6);
	}

	/* Retorna anuncios de servicios activos y de categoria n..donde n= "categoria seleccionada por el usuario "*/
	public function serviciosCategoriaN($categoria_id)
	{
		return Anuncio::where('seccion_id','=', 2)->where('estado_id','=', 1)->where('categoria_id','=',$categoria_id)->orderBy('publicaciondate', 'desc')->paginate(6);
	}

	/* Retorna anuncios de empleos activos y de categoria n..donde n= "categoria seleccionada por el usuario" */
	public function empleosCategoriaN($categoria_id)
	{
		return Anuncio::where('seccion_id','=', 3)->where('estado_id','=', 1)->where('categoria_id','=',$categoria_id)->orderBy('publicaciondate', 'desc')->paginate(6);
	}


	/* Retorna anuncios activos de clasificados, Servicios o Empleos, de subcategoria n..donde n="subcategoria seleccionada por el usuario" */
	public function anunciosSubcategorian($subcategoria_id)
	{
		return Anuncio::where('estado_id','=', 1)->where('subcategoria_id','=',$subcategoria_id)->orderBy('publicaciondate', 'desc')->paginate(6);
	}
	
	public function enumerar_anuncios_usuario($usuario_id)
	{
		return Anuncio::where('usuario_id','=', $usuario_id)->count();	
	}

}
