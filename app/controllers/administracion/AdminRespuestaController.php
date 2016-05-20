<?php namespace administracion;

use Anuncia\Repositorios\RespuestaRepo;
use Anuncia\Repositorios\DenunciaRepo;
use Anuncia\Repositorios\HistorialRepo;
use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\ConfiguracionRepo;

/**
 * ----------------------------------------------------
 * Clase que permite a un Administrador: 
 * 		- Gestionar (revisar, aprobar, rechazar) respuestas denunciadas
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

class AdminRespuestaController extends \BaseController
{
	protected $respuestaRepo;
	protected $denunciaRepo;
	protected $historialRepo;
	protected $usuarioRepo;
	protected $configuracionRepo;

	public function __construct(RespuestaRepo $respuestaRepo,
								DenunciaRepo $denunciaRepo,
								HistorialRepo $historialRepo,
								UsuarioRepo $usuarioRepo,
								ConfiguracionRepo $configuracionRepo)
	{
		$this->respuestaRepo=$respuestaRepo;
		$this->denunciaRepo=$denunciaRepo;
		$this->historialRepo=$historialRepo;
		$this->usuarioRepo=$usuarioRepo;
		$this->configuracionRepo=$configuracionRepo;
	}

	/* Muestra las respuestas denunciadas que necesitan revisión*/
	public function mostrarRespuestasDenunciadas()
	{
		$respuestas = $this->respuestaRepo->buscarRespuestasDenunciadas();

		return \View::make('modulos.administracion.listarespuestasdenunciadas',
							compact('respuestas')
				);
	}

	/* Muestra las respuestas denunciadas que está aún siendo revisadas por un administrador */
	public function mostrarRespuestasDenunciadasPendientes()
	{
		$respuestas = $this->respuestaRepo->respuestasDenunciadasPendientes(\Auth::id());
		
		return \View::make('modulos.administracion.listarespuestasdenunciadas',
							compact('respuestas')
				);	
	}

	/* Muestra la respuesta denunciada detalladamente para aprobar o rechazar la denuncia*/
	public function revisarRespuestaDenunciada($respuesta_id)
	{
		$respuesta = $this->respuestaRepo->buscarRespuesta($respuesta_id);
		$this->notFoundUnLess($respuesta);

		# admin es requerido si la respuesta denunciada ya está siendo revisado por un administrador
		$admin = \Auth::id();

		$denuncia=$this->denunciaRepo->buscarDenunciaTipoRespuesta($respuesta->id);
		$this->notFoundUnLess($denuncia);

		// Solo respuestas denunciadas pueden ser revisadas
		# respuesta estatus denunciado
		$estatusRevision = $respuesta->estatus_revision;

		if (\Helper::compararCadenas($estatusRevision, "libre") & (\Helper::compararCadenas($respuesta->estatus, "denunciado")))
		{
			$this->respuestaRepo->estatusRevisionOcupado($respuesta, $admin);
			
			return \View::make('modulos.administracion.revisionrespuesta',
								compact('respuesta', 'denuncia')
					);
		}
		else if (\Helper::compararCadenas($estatusRevision, "ocupado") & ($respuesta->admin == $admin))
		{
			return \View::make('modulos.administracion.revisionrespuesta',
								compact('respuesta', 'denuncia')
					);
		}
		else if(\Helper::compararCadenas($estatusRevision,"ocupado") & ($respuesta->admin != $admin))
		{
			return \Redirect::route('admin.revisar.respuestas.denunciadas')->with('status_error', 
																				  'Esta respuesta denunciada ya la 
																				  está revisando otro administrador.');
		}
		else
		{
			return \Redirect::route('admin.revisar.respuestas.denunciadas')->with('status_error',
																				 'Esta respuesta no ha sido denunciada.');
		}
	}

	/* Aprueba la denuncia sobre la respuesta */
	public function aprobarDenunciaRespuesta()
	{
		try
		{
			\DB::beginTransaction();

			// Si la denuncia es verdadera se elimina la respuesta y se abre un historial al denunciado
			// Igualmente se abre un historial al denunciante para incrementar las denuncias verdaderas realizadas
		
			# historial para el denunciado, sus comentarioseliminados incrementan
			$historialDenunciado= $this->historialRepo->nuevoHistorial(\Input::get('denunciado_id'));
			$historialDenunciado->comentarioseliminados++;
			$this->historialRepo->save($historialDenunciado);

			# historial para el denunciante, sus denuncias verdaderas incrementan
			$historialDenunciante= $this->historialRepo->nuevoHistorial(\Input::get('denunciante_id'));
			$historialDenunciante->denunciasverdaderas++;
			$this->historialRepo->save($historialDenunciante);

			$respuesta_id = \Input::get('respuesta_id');

			if ($this->respuestaRepo->eliminarRespuestaId($respuesta_id))
			{
				# se elimina la denuncia una vez se ha revisado y gestionado
				$this->denunciaRepo->eliminarDenunciaTipoRespuesta($respuesta_id);

				# se requiere la configuracion del sistema para conocer las respuestas bloqueadas permitidas
				// las respuestas se eliminan no se bloquean
				$configuracion = $this->configuracionRepo->cargarConfiguracionActual();
				$comentariosBloqueadosPermitidos = $configuracion->comentariosbloqueados;

				# si los comentarios bloqueados del denunciado es >= que comentarios bloqueados permitidos, se bloquea denunciado 
				/* bloqueo de usuario */
				if($historialDenunciado->comentarioseliminados >= $comentariosBloqueadosPermitidos){
					$this->usuarioRepo->bloquearUsuario($historialDenunciado->usuario_id);
				}

				\DB::commit();

				return \Redirect::route('admin.revisar.respuestas.denunciadas')->with('status_ok', 
																				      'Respuesta revisada y bloqueada 
																				   	   correctamente');
			}
			return \Redirect::route('admin.revisar.respuestas.denunciadas')->with('status_error', 
																				  'No se pudo eliminar la
																				   respuesta');
		}
		catch(\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}	
	}
	
	/* Rechaza la denuncia sobre la respuesta */
	public function rechazarDenunciaRespuesta()
	{
		try 
		{
			\DB::beginTransaction();

			// Si la denuncia es falsa se reactiva la respuesta y se abre un historial al denunciante
			// Se abre el historial al denunciante para incrementar sus denuncias falsas

			# historial para el denunciante, sus denuncias falsas incrementan
			$historialDenunciante = $this->historialRepo->nuevoHistorial(\Input::get('denunciante_id'));
			$historialDenunciante->denunciasfalsas++;
			$this->historialRepo->save($historialDenunciante);

			
			$respuesta_id = \Input::get('respuesta_id');

			if($this->respuestaRepo->reactivarRespuestaId($respuesta_id))
			{
				# se elimina la denuncia una vez se ha revisado y gestionado
				$this->denunciaRepo->eliminarDenunciaTipoRespuesta($respuesta_id);

				# se requiere la configuracion del sistema para conocer el contadorDeDenuncias del sistema permitido
				$configuracion = $this->configuracionRepo->cargarConfiguracionActual();
				$contadorDeDenuncias = $configuracion->contadordedenuncias;

				# contadordedenuncias del denunciante
				$contadordenuncias= $historialDenunciante->denunciasfalsas - $historialDenunciante->denunciasverdaderas;

				// el contadordedenuncias almacena la diferencia entre las denuncias falsas y  verdaderas
				// denuncias falsas - denuncias verdaderas
				// Si el contadordedenuncias del denunciante supera el número máximo permitido por el sistema, 
				// se bloquea al usuario por abusar del sistema de denuncias 

				# si contadordedenuncias del denunciante es >= al contadorDeDenuncias del sistema se bloquea denunciante
				
				if($contadordenuncias >= $contadorDeDenuncias )
				{
					$this->usuarioRepo->bloquearUsuario($historialDenunciante->usuario_id);
				}

				\DB::commit();

				return \Redirect::route('admin.revisar.respuestas.denunciadas')->with('status_ok', 
																				  'Respuesta revisada y 
																				  reactivada correctamente');
			}

			return \Redirect::route('admin.revisar.respuestas.denunciadas')->with('status_error', 
																				  'La respuesta no pudo ser 
																				  reactivada');
		}
		catch (\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}			
	}
}
