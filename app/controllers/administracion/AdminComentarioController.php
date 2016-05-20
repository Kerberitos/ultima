<?php namespace administracion;

use Anuncia\Repositorios\ComentarioRepo;
use Anuncia\Repositorios\DenunciaRepo;
use Anuncia\Repositorios\CuentaRepo;
use Anuncia\Repositorios\HistorialRepo;
use Anuncia\Repositorios\ConfiguracionRepo;
use Anuncia\Repositorios\UsuarioRepo;

/**
 * ----------------------------------------------------
 * Clase que permite a un Administrador: 
 * 		- Gestionar (revisar, aprobar, rechazar) comentarios denunciados
 * ----------------------------------------------------
 * Rutas:
 * 		- miradita/app/routes/admin.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class AdminComentarioController extends \BaseController
{
	protected $comentarioRepo;
	protected $cuentaRepo;
	protected $configuracionRepo;
	protected $denunciaRepo;
	protected $historialRepo;
	protected $usuarioRepo;

	public function __construct(ComentarioRepo $comentarioRepo,
								ConfiguracionRepo $configuracionRepo,
								CuentaRepo $cuentaRepo,
								DenunciaRepo $denunciaRepo,
								HistorialRepo $historialRepo,
								UsuarioRepo $usuarioRepo)
	{
		$this->comentarioRepo = $comentarioRepo;
		$this->cuentaRepo = $cuentaRepo;
		$this->configuracionRepo = $configuracionRepo;
		$this->denunciaRepo = $denunciaRepo;
		$this->historialRepo = $historialRepo;
		$this->usuarioRepo = $usuarioRepo;
	}

	/* Muestra los comentarios denunciados que necesitan revisión*/
	public function mostrarComentariosDenunciados()
	{
		$comentarios = $this->comentarioRepo->buscarComentariosDenunciados();

		return \View::make('modulos.administracion.listacomentariosdenunciados',
							compact('comentarios')
				);
	}

	/* Muestra los comentarios denunciados que está aún siendo revisados por un administrador */
	public function mostarComentariosDenunciadosPendientes()
	{
		$comentarios = $this->comentarioRepo->comentariosDenunciadosPendientes(\Auth::id());
		
		return \View::make('modulos.administracion.listacomentariosdenunciados',
							compact('comentarios')
				);
	}

	/* Muestra el comentario denunciado detalladamente para aprobar o rechazar la denuncia*/
	public function revisarComentarioDenunciado($comentarioId)
	{
		$comentario = $this->comentarioRepo->buscarComentario($comentarioId);
		$this->notFoundUnLess($comentario);

		# admin es requerido si el comentario denunciado ya está siendo revisado por un administrador
		$admin = \Auth::id();

		$denuncia = $this->denunciaRepo->buscarDenunciaTipoComentario($comentario->id);
		$this->notFoundUnLess($denuncia);

		// Solo comentarios denunciados pueden ser revisados
		$estatusRevision = $comentario->estatus_revision;

		# comentario estatus denunciado
		if (\Helper::compararCadenas($estatusRevision, "libre") & (\Helper::compararCadenas($comentario->estatus, "denunciado"))) 
		{
			$this->comentarioRepo->estatusRevisionOcupado($comentario, $admin);
			
			return \View::make('modulos.administracion.revisioncomentario',
					           compact('comentario', 'denuncia')
					);
		}
		else if (\Helper::compararCadenas($estatusRevision, "ocupado") & ($comentario->admin == $admin))
		{
			return \View::make('modulos.administracion.revisioncomentario',
							   compact('comentario', 'denuncia')
					);
		}
		else if (\Helper::compararCadenas($estatusRevision,"ocupado") & ($comentario->admin != $admin))
		{
			return \Redirect::route('admin.revisar.comentarios.denunciados')->with('status_error', 
																				   'El comentario denunciado 
																				    ya lo está revisando otro 
																				    administrador.');
		}
		else
		{
			return \Redirect::route('admin.revisar.comentarios.denunciados')->with('status_error', 
																					'Este comentario no 
																					 ha sido denunciado.');
		}
	}

	/* Aprueba la denuncia sobre el comentario */
	public function aprobarDenunciaComentario()
	{
		try
		{
			\DB::beginTransaction();

			// Si la denuncia es verdadera se elimina el comentario y se abre un historial al denunciado
			// Igualmente se abre un historial al denunciante para incrementar las denuncias verdaderas realizadas
		
			# historial para el denunciado, sus comentarioseliminados incrementan
			$historialDenunciado= $this->historialRepo->nuevoHistorial(\Input::get('denunciado_id'));
			$historialDenunciado->comentarioseliminados++;
			$this->historialRepo->save($historialDenunciado);

			# historial para el denunciante, sus denuncias verdaderas incrementan
			$historialDenunciante= $this->historialRepo->nuevoHistorial(\Input::get('denunciante_id'));
			$historialDenunciante->denunciasverdaderas++;
			$this->historialRepo->save($historialDenunciante);

			$comentario_id = \Input::get('comentario_id');

			if ($this->comentarioRepo->eliminarComentarioId($comentario_id))
			{
				# se elimina la denuncia una vez se ha revisado y gestionado
				$this->denunciaRepo->eliminarDenunciaTipoComentario($comentario_id);

				# se requiere la configuracion del sistema para conocer los comentarios bloqueados permitidos
				// los comentarios se eliminan no se bloquean
				$configuracion = $this->configuracionRepo->cargarConfiguracionActual();
				$comentariosBloqueadosPermitidos = $configuracion->comentariosbloqueados;

				# si los comentarios bloqueados del denunciado es >= que comentarios bloqueados permitidos, se bloquea denunciado 
				/*bloqueo de usuario */
				if ($historialDenunciado->comentarioseliminados >= $comentariosBloqueadosPermitidos){
					$this->cuentaRepo->bloquearCuenta($historialDenunciado->usuario_id);
				}
				
				\DB::commit();
				
				return \Redirect::route('admin.revisar.comentarios.denunciados')->with('status_ok', 
																				   	   'Comentario revisado 
																				   	    y bloqueado correctamente');
			}

			return \Redirect::route('admin.revisar.comentarios.denunciados')->with('status_error', 
																				   'No se pudo eliminar el 
																				    comentario');
		}
		catch(\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}	
	}
	
	/* Rechaza la denuncia sobre el comentario */
	public function rechazarDenunciaComentario()
	{
		try 
		{
			\DB::beginTransaction();

			// Si la denuncia es falsa se reactiva el comentario y se abre un historial al denunciante
			// Se abre el historial al denunciante para incrementar sus denuncias falsas

			# historial para el denunciante, sus denuncias falsas incrementan
			$historialDenunciante = $this->historialRepo->nuevoHistorial(\Input::get('denunciante_id'));
			$historialDenunciante->denunciasfalsas++;
			$this->historialRepo->save($historialDenunciante);

			$comentario_id = \Input::get('comentario_id');

			if($this->comentarioRepo->reactivarComentarioId($comentario_id))
			{
				# se elimina la denuncia una vez se ha revisado y gestionado
				$this->denunciaRepo->eliminarDenunciaTipoComentario($comentario_id);

				# se requiere la configuracion del sistema para conocer el contadorDeDenuncias del sistema permitido
				$configuracion = $this->configuracionRepo->cargarConfiguracionActual();
				$contadorDeDenuncias = $configuracion->contadordedenuncias;

				# contadordedenuncias del denunciante
				$contadordenuncias = $historialDenunciante->denunciasfalsas - $historialDenunciante->denunciasverdaderas;

				// el contadordedenuncias almacena la diferencia entre las denuncias falsas y  verdaderas
				// denuncias falsas - denuncias verdaderas
				// Si el contadordedenuncias del denunciante supera el número máximo permitido por el sistema, 
				// se bloquea al usuario por abusar del sistema de denuncias 

				# si contadordedenuncias del denunciante es >= al contadorDeDenuncias del sistema se bloquea denunciante

				if ($contadordenuncias >= $contadorDeDenuncias)
				{
					$this->cuentaRepo->bloquearCuenta($historialDenunciante->usuario_id);
				}

				\DB::commit();

				return \Redirect::route('admin.revisar.comentarios.denunciados')->with('status_ok', 
																				   'Comentario revisado y 
																				    reactivado correctamente');
			}
			return \Redirect::route('admin.revisar.comentarios.denunciados')->with('status_error', 
																				   'El comentario no pudo
																				   ser reactivado');
		}
		catch (\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}		
	}
}
