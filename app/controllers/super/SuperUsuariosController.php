<?php namespace super;

use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\PostulanteRepo;
use Anuncia\Repositorios\ConfiguracionRepo;
use Anuncia\Repositorios\CuentaRepo;
/**
 * ----------------------------------------------------
 * Clase que : 
 * 		- Muestra los distintos paneles de Usuarios
 *			-> Panel de usuairos activos
 *			-> Panel de usuarios postulantes a administradores
 *			-> Panel de usuarios bloqueados 
 *			-> Panel de usuarios desactivados 
 * ----------------------------------------------------
 * Rutas:
 * 		- miradita/app/routes/super.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class SuperUsuariosController extends \BaseController
{
	protected $usuarioRepo;
	protected $cuentaRepo;
	protected $postulanteRepo;
	protected $configuracionRepo;

	public function __construct(UsuarioRepo $usuarioRepo,
								CuentaRepo $cuentaRepo,
								PostulanteRepo $postulanteRepo,
								ConfiguracionRepo $configuracionRepo)
	{
		$this->postulanteRepo = $postulanteRepo;
		$this->usuarioRepo = $usuarioRepo;
		$this->cuentaRepo = $cuentaRepo;
		$this->configuracionRepo = $configuracionRepo;
	}
	
	/* Muestra panel de usuarios al Super administrador */
	// No confundir con panel de usuarios de Administrador
	public function panelUsuarios()
	{
		$numPostulantes = $this->getNumeroPostulantes();
		$numUsuariosBloqueados = $this->getNumeroUsuariosBloqueados();
		$numUsuariosActivos = $this->getNumeroUsuariosActivos();
		$numUsuariosDesactivados = $this->getNumeroUsuariosDesactivados();
		
		return \View::make('modulos.super.panelusuarios', 
							compact('numUsuariosActivos',
									'numUsuariosBloqueados',
									'numUsuariosDesactivados',
									'numPostulantes')
				);
	}
	
	/* Obtiene número de usuarios postulantes a administradores */
	public function getNumeroPostulantes()
	{
		return $this->postulanteRepo->enumerarPostulantes();		
	}

	/* Obtiene número de usuarios bloqueados */	
	public function getNumeroUsuariosBloqueados()
	{
		return $this->cuentaRepo->enumerarCuentasBloqueadas();	
	}

	/* Obtiene número de usuarios activos */
	public function getNumeroUsuariosActivos()
	{
		return $this->cuentaRepo->enumerarCuentasActivas();		
	}
	
	/* Obtiene número de usuarios desactivados */
	public function getNumeroUsuariosDesactivados()
	{
		return $this->cuentaRepo->enumerarCuentasDesactivadas();		
	}
	
	/* *Muestra usuarios postulantes a administradores */
	public function usuariosPostulantes()
	{
		$usuarios = $this->postulanteRepo->postulantes();
		
		return \View::make('modulos.super.listapostulantes',
							compact('usuarios')
				);
	}
	
	/* *Muestra en detalle usuario postulante a administrador */
	public function verPostulante($id)
	{
		$usuario = $this->usuarioRepo->buscarUsuario($id);
		return \View::make('modulos.super.verpostulante', 
							compact('usuario')
				);
	}

	/* Muestra usuarios bloqueados */
	public function usuariosBloqueados()
	{
		$busqueda = trim(\Input::get('busqueda'));
		#estado 2 esquivalente a desactivado
		$estado = 2;

		$textobuscado="";

		if ($busqueda == "")
		{
			// si el input de busqueda está vacio no es necesario realizar acciones 
		}
		else if ($busqueda != "")
		{
			$textobuscado = $busqueda;
			//$usuarios = $this->usuarioRepo->busquedaUsuariosPorNombre($busqueda, $estado);
			
			$cuentas = $this->cuentaRepo->busquedaCuentasPorCorreoEstado($busqueda, $estado);

			# sizeof devuelve el tamaño del argumento recibido
			if (sizeof($cuentas) == 0)
			{
				return \Redirect::route('lista.usuarios.bloqueados')->with('status_nohaycoincidencias',
																			   'No hay resultados de búsqueda 
																			    para '.$textobuscado);
			}
			
			return \View::make('modulos.super.listausuariosbloqueados', 
									compact('cuentas','textobuscado', 'rolenvista')
						);
		}

		$cuentas = $this->cuentaRepo->cuentasBloqueadas();

		return \View::make('modulos.super.listausuariosbloqueados', 
							compact('cuentas','textobuscado', 'rolenvista')
				);
	}	

	
	/* Muestra usuarios desactivados */
	public function usuariosDesactivados()
	{
		
		$busqueda = trim(\Input::get('busqueda'));
		#estado 2 esquivalente a desactivado
		$estado = 2;

		$textobuscado="";

		if ($busqueda == "")
		{
			// si el input de busqueda está vacio no es necesario realizar acciones 
		}
		else if ($busqueda != "")
		{
			$textobuscado = $busqueda;
			//$usuarios = $this->usuarioRepo->busquedaUsuariosPorNombre($busqueda, $estado);
			
			$cuentas = $this->cuentaRepo->busquedaCuentasPorCorreoEstado($busqueda, $estado);

			# sizeof devuelve el tamaño del argumento recibido
			if (sizeof($cuentas) == 0)
			{
				return \Redirect::route('lista.usuarios.desactivados')->with('status_nohaycoincidencias', 
																				 'No hay resultados de búsqueda
																				  para '.$textobuscado);
			}
			
			return \View::make('modulos.super.listausuariosdesactivados', 
									compact('cuentas','textobuscado', 'rolenvista')
						);
		}

		$cuentas = $this->cuentaRepo->cuentasDesactivadas();

		return \View::make('modulos.super.listausuariosdesactivados', 
							compact('cuentas','textobuscado', 'rolenvista')
				);
	}


	/* Muestra usuario activos */
	public function usuariosActivos()
	{
		$busqueda = trim(\Input::get('busqueda'));
		$estado = 1;

		$textobuscado="";

		if ($busqueda == "")
		{
			// si el input de busqueda está vacio no es necesario realizar acciones 
		}
		else if ($busqueda != "")
		{
			$textobuscado = $busqueda;
			//$usuarios = $this->usuarioRepo->busquedaUsuariosPorNombre($busqueda, $estado);
			
			$cuentas = $this->cuentaRepo->busquedaCuentasPorCorreoEstado($busqueda, $estado);

			# sizeof devuelve el tamaño del argumento recibido
			if (sizeof($cuentas) == 0)
			{
				return \Redirect::route('lista.usuarios.activos')->with('status_nohaycoincidencias', 
																			'No hay resultados de búsqueda 
																			 para '.$textobuscado);
			}
			
			return \View::make('modulos.super.listausuariosactivos', 
									compact('cuentas','textobuscado', 'rolenvista')
						);
		}

		$cuentas = $this->cuentaRepo->cuentasActivas();

		return \View::make('modulos.super.listausuariosactivos', 
							compact('cuentas','textobuscado', 'rolenvista')
				);
	}


	/* Muestra en detalle usuario activado, bloqueado o desactivado */
	public function verUsuario($id)
	{
		$usuario = $this->usuarioRepo->buscarUsuario($id);

		
		$this->notFoundUnLess($usuario);

		if (\Auth::user()->usuario->rol_id == 3)
		{
			$configuracionActual =  $this->configuracionRepo->cargarConfiguracionActual();

			return \View::make('modulos.super.verdetalleusuario', 
								compact('usuario','configuracionActual')
					);
		}
	}
	
}
