<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Usuario;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class UsuarioRepo extends BaseRepo
{
	public function getModel()
	{
		return new Usuario;	
	}
	
	public function nuevoUsuario($data)
	{
		$usuario = new Usuario();
		$usuario->rol_id = 1;
		//$usuario->compania_id = 1;
		
		if (array_key_exists('nombres', $data))
		{
			$usuario->slug = \Str::slug($data['nombres']);	
		}
		else
		{
			$nombreTemporal = 'Usuario';
			$usuario->nombres = $nombreTemporal;
			$usuario->slug = \Str::slug($nombreTemporal);
		}
		
		
		//$usuario->slug = \Str::slug($nombres);
		$usuario->cambio = false;

		return $usuario;
	}

	/* *Devuelve los administradores del sistema en orden alfabetico*/
	public function buscarAdministradores()
	{
		return Usuario::where('rol_id','=', 2)->orWhere('rol_id','=', 3)->orderBy('nombres', 'asc')->paginate(6);
	}

	/* *Busca usuario por su id */
	public function buscarUsuario($usuarioId)
	{
		return Usuario::find($usuarioId);
	}





	/* -----Devuelve los usuarios buscando por su nombre y estado */
	public function busquedaUsuariosPorNombre($busqueda, $estado)
	{
		/*return  Usuario::where('estado_id', '=', $estado)->where(function($query) use($busqueda) {
                $query->where('nombres', 'like', '%'.$busqueda.'%')->orWhere('correo', 'like', '%'.$busqueda.'%');
            })->paginate(1);*/

        return  Usuario::where(function($query) use($busqueda) {
                $query->where('nombres', 'like', '%'.$busqueda.'%')->orWhere('correo', 'like', '%'.$busqueda.'%');
            })->paginate(6);    	
	}

		
	/* Asciende usuario a administrador */
	public function ascenderAAdministrador($usuario_id)
	{
		$usuario = Usuario::find($usuario_id);
		$usuario->rol_id = 2;
		$usuario->nav_avanzada = true;
		$usuario->save();

		return true;
	}

	/* Asciende usuario a Super administrador */
	public function ascenderASuper($usuario_id)
	{
		$usuario = Usuario::find($usuario_id);
		$usuario->rol_id = 3;
		$usuario->nav_avanzada = true;
		$usuario->save();

		return true;
	}

	/* Desciende Super administrador a administrador */
	public function descenderAAdministrador($usuario_id)
	{
		$usuario = Usuario::find($usuario_id);
		$usuario->rol_id = 2;
		$usuario->save();

		return true;
	}

	/* Desciende Administrador a usuario */
	public function descenderAUsuario($usuario_id)
	{
		$usuario = Usuario::find($usuario_id);
		$usuario->rol_id = 1;
		$usuario->nav_avanzada = false;
		$usuario->save();

		return true;
	}

	/* Busca usuario mediante el campo random (token generado aleatoriamente) */
	/*public function buscarUsuarioRandom($random)
	{
		$usuario = Usuario::whereRandom($random)->first();
		
		return $usuario;
	}*/










	/* Verifica si existe usuario en el sistema mediante su correo */
	public function existeUsuario($correo)
	{
		$usuario = Usuario::whereCorreo($correo)->first();
		
		if (!empty($usuario))
		{
			return true;
		}
		return false;
	}

	public function usuarioAnonimo()
	{
		$user = new Usuario();
		return $user;
	}
	
	public function busquedaUsuariosPorNombreRol($busqueda, $rol, $estado)
	{
		return  Usuario::where('estado_id', '=', $estado)->where('rol_id', '=', $rol)->where(function($query) use($busqueda) {
                $query->where('nombres', 'like', '%'.$busqueda.'%')->orWhere('correo', 'like', '%'.$busqueda.'%');
            })->paginate(1);	
		 
	}

	public function buscarUsuariosPorRol($rol, $estado)
	{
		$usuarios= Usuario::where('estado_id','=', $estado)->where('rol_id','=', $rol)->paginate(1);
		
		return $usuarios;
	}

	

	
	



	


	public function buscarAdministradoresBloqueadores($anunciosBloqueados){

		$administradores = [];

		foreach ($anunciosBloqueados as $anuncio )
		{
			$administrador = Usuario::where('id','=', $anuncio->admin)->first();
			$administradores[] =  $administrador->nombres; 
		}

		return $administradores;
	}
}
