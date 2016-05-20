<?php namespace administracion;

use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\CuentaRepo;
use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\ComentarioRepo;
use Anuncia\Repositorios\RespuestaRepo;
use Anuncia\Repositorios\IncidenteRepo;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- manipular el Panel Principal de Administrador
 * 		- visualizar al equipo de administradores 
 * ----------------------------------------------------
 * Rutas:
 * 		- miradita/app/routes/admin.php
 *		- miradita/app/routes/basicas.php
 *
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class AdministradorController extends \BaseController
{
	protected $usuarioRepo;
	protected $cuentaRepo;
	protected $anuncioRepo;
	protected $comentarioRepo;
	protected $respuestaRepo;
	protected $incidenteRepo;
	
	public function __construct(UsuarioRepo $usuarioRepo,
								CuentaRepo $cuentaRepo,
								AnuncioRepo $anuncioRepo,
								ComentarioRepo $comentarioRepo,
								RespuestaRepo $respuestaRepo,
								IncidenteRepo $incidenteRepo)
	{
		$this->usuarioRepo = $usuarioRepo;
		$this->cuentaRepo = $cuentaRepo;
		$this->anuncioRepo = $anuncioRepo;
		$this->comentarioRepo = $comentarioRepo;
		$this->respuestaRepo = $respuestaRepo;
		$this->incidenteRepo = $incidenteRepo;
	}
	
	/* *Activa el menú de administrador*/
	public function activarMenuAdministrador()
	{
		$cuenta = \Auth::user();

		if ($cuenta->nav_avanzada == false)
		{
			$cuenta->nav_avanzada = true;
			$cuenta->save();
		}

		return \Redirect::route('administracion');
	}

	/* Desactiva el menú de administrador*/
	public function desactivarMenuAdministrador()
	{
		$cuenta = \Auth::user();

		if ($cuenta->nav_avanzada == true)
		{
			$cuenta->nav_avanzada = false;
			$cuenta->save();

			return \Redirect::route('main');
		}
	}

	/*Muestra el panel general de Administrador*/
	public function getPanelGeneral()
	{
		
		# variables enviadas a la vista que muestra el Panel General de Administrador
		$anunciosPorRevisar = $this->getNumeroAnunciosPorRevisar();
		$anunciosDenunciados = $this->getNumeroAnunciosDenunciados();
		$anunciosBloqueados = $this->getNumeroAnunciosBloqueados();
		$usuariosBloqueados = $this->getNumeroUsuariosBloqueados();
		$usuariosDesactivados = $this->getNumeroUsuariosDesactivados();
		$comentariosDenunciados = $this->getNumeroComentariosDenunciados();
		$respuestasDenunciadas = $this->getNumeroRespuestasDenunciadas();
		
		
		// Las Tareas pendientes son las tareas iniciadas por un 
		// administrador y que aún no han sido culminadas
		
		$totalTareasPendientes = $this->getNumeroAnunciosPendientes() + 
								 $this->getNumeroAnunciosDenunciadosPendientes() +
								 $this->getNumeroComentariosDenunciadosPendientes()+
								 $this->getNumeroRespuestasDenunciadasPendientes();

		return \View::make('modulos.administracion.general',compact('anunciosPorRevisar', 
																	'anunciosDenunciados',
																	'anunciosBloqueados',
																	'usuariosBloqueados',
																	'usuariosDesactivados',
																	'comentariosDenunciados',
																	'respuestasDenunciadas',
																	'totalTareasPendientes')
				);
	}

	public function getNumeroAnunciosPorRevisar()
	{
		return $this->anuncioRepo->enumerarAnunciosPorRevisar();
	}

	public function getNumeroAnunciosDenunciados()
	{
		return $this->anuncioRepo->enumerarAnunciosDenunciados();		
	}

	public function getNumeroAnunciosBloqueados()
	{
		return $this->anuncioRepo->enumerarAnunciosBloqueados();	
	}

	public function getNumeroComentariosDenunciados()
	{
		return $this->comentarioRepo->enumerarComentariosDenunciados();
	}

	public function getNumeroRespuestasDenunciadas()
	{
		return $this->respuestaRepo->enumerarRespuestasDenunciadas();
	}

	public function getNumeroUsuariosBloqueados()
	{
		return $this->cuentaRepo->enumerarCuentasBloqueadas();	
	}

	public function getNumeroUsuariosDesactivados()
	{
		return $this->cuentaRepo->enumerarCuentasDesactivadas();
	}

	
	/* Muestra el Panel de Tareas Pendientes */
	public function getPanelTareasPendientes()
	{
		#variables enviadas a la vista del Panel de tareas pendientes
		$anunciosPendientes=$this->getNumeroAnunciosPendientes();
		$anunciosDenunciadosPendientes=$this->getNumeroAnunciosDenunciadosPendientes();
		$comentariosDenunciadosPendientes= $this->getNumeroComentariosDenunciadosPendientes();
		$respuestasDenunciadasPendientes= $this->getNumeroRespuestasDenunciadasPendientes();

		return \View::make('modulos.administracion.tareaspendientes', compact('anunciosPendientes',
																			  'anunciosDenunciadosPendientes',
																			  'comentariosDenunciadosPendientes',
																			  'respuestasDenunciadasPendientes')
				);
	}
	
	public function getNumeroAnunciosPendientes()
	{
		return $this->anuncioRepo->enumerarAnunciosPendientes(\Auth::id());
	}

	public function getNumeroAnunciosDenunciadosPendientes()
	{
		return $this->anuncioRepo->enumerarAnunciosDenunciadosPendientes(\Auth::id());
	}

	public function getNumeroComentariosDenunciadosPendientes()
	{
		return $this->comentarioRepo->enumerarComentariosDenunciadosPendientes(\Auth::id());
	}

	public function getNumeroRespuestasDenunciadasPendientes()
	{
		return $this->respuestaRepo->enumerarRespuestasDenunciadasPendientes(\Auth::id());
	}

	/* *Muestra todos los administradores del sistema */
	public function cargarAdministradores()
	{
		$usuarios = $this->usuarioRepo->buscarAdministradores();
		
		return \View::make('modulos.administracion.listaadmins', 
							compact('usuarios')
				);
	}
	
	/* -Muestra un administrador de forma individual */
	public function verAdministrador($id, $slug)
	{
		$usuario = $this->usuarioRepo->buscarUsuario($id);
		$this->notFoundUnLess($usuario);

		// Solo un administrador o super administrador puede visualizar equipo de administradores
		# administrador = rol 2 y super admin = rol 3

		if ($usuario->rol_id == 2 | $usuario->rol_id == 3)
		{
			return \View::make('modulos.administracion.veradministrador', 
								compact('usuario')
					);	
		}
		
		return \App::abort(404);
	}
}