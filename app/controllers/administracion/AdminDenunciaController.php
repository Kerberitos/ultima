<?php namespace administracion;

use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\CategoriaRepo;
use Anuncia\Repositorios\SubcategoriaRepo;
use Anuncia\Repositorios\DenunciaRepo;
use Anuncia\Repositorios\HistorialRepo;
use Anuncia\Repositorios\HistorialanuncioRepo;
use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\CuentaRepo;
use Anuncia\Repositorios\ConfiguracionRepo;

use Anuncia\Managers\HistorialanuncioManager;
/**
 * ----------------------------------------------------
 * Clase que permite a un Administrador: 
 * 		- Gestionar las denuncias realizadas a los anuncios
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

class AdminDenunciaController extends \BaseController
{
	protected $anuncioRepo;
	protected $denunciaRepo;
	protected $historialRepo;
	protected $historialanuncioRepo;
	protected $usuarioRepo;
	protected $cuentaRepo;
	protected $configuracionRepo;

	public function __construct(AnuncioRepo $anuncioRepo,
								DenunciaRepo $denunciaRepo,
								HistorialRepo $historialRepo,
								HistorialanuncioRepo $historialanuncioRepo,
								UsuarioRepo $usuarioRepo,
								CuentaRepo $cuentaRepo,
								ConfiguracionRepo $configuracionRepo)
	{
		$this->anuncioRepo=$anuncioRepo;
		$this->denunciaRepo=$denunciaRepo;
		$this->historialRepo=$historialRepo;
		$this->historialanuncioRepo = $historialanuncioRepo;
		$this->usuarioRepo=$usuarioRepo;
		$this->cuentaRepo = $cuentaRepo;
		$this->configuracionRepo=$configuracionRepo;
	}

	/* Muestra los anuncios denunciados que necesitan revisión*/
	public function mostrarAnunciosDenunciados()
	{
		$anuncios = $this->anuncioRepo->buscarAnunciosDenunciados();

		return \View::make('modulos.administracion.anunciosdenunciados',
							compact('anuncios')
				);
	}
	
	/* Muestra los anuncios denunciados que está aún siendo revisados por un administrador */
	public function mostrarAnunciosDenunciadosPendientes()
	{
		$anuncios = $this->anuncioRepo->buscarDenunciadosPendientes(\Auth::id());

		return \View::make('modulos.administracion.listadenunciadospendientes',
							compact('anuncios')
				);
	}
	
	/* Muestra el anuncio denunciado detalladamente para aprobar o rechazar la denuncia*/
	public function revisarAnuncioDenunciado($seccion, $anuncioId)
	{
		$anuncio = $this->anuncioRepo->buscarAnuncioId($anuncioId);
		$this->notFoundUnLess($anuncio);

		# admin es requerido si el anuncio ya está siendo revisado por un administrador
		$admin = \Auth::id();
		
		$denuncia = $this->denunciaRepo->buscarDenunciaTipoAnuncio($anuncio->id);
		$this->notFoundUnLess($denuncia);

		// Solo anuncios denunciados pueden ser revisados
		# anuncio con estado_id de 6 = anuncio con estado de denunciado  
		if (\Helper::compararCadenas($anuncio->estatus_revision, "libre") & ($anuncio->estado_id == 6))
		{
			$this->anuncioRepo->estatusRevisionOcupado($anuncio, $admin);

			return \View::make('modulos.administracion.revisionindividual', 
								compact('anuncio', 'denuncia')
					); 
		}
		else if (\Helper::compararCadenas($anuncio->estatus_revision, "ocupado") & ($anuncio->admin == $admin))
		{
			return \View::make('modulos.administracion.revisionindividual',
								compact('anuncio', 'denuncia')
					); 
		}
		else if (\Helper::compararCadenas($anuncio->estatus_revision, "ocupado") & ($anuncio->admin != $admin))
		{
			return \Redirect::route('admin.revisar.denuncias')->with('status_error', 
																	'Este anuncio lo está revisando otro administrador.');
		}
		else
		{
			return \Redirect::route('admin.revisar.denuncias')->with('status_error', 
																	'Ese anuncio no ha sido denunciado.');
		}
	}

	/* Aprueba la denuncia sobre el anuncio */
	public function aprobarDenuncia()
	{

		try
		{
			\DB::beginTransaction();
			$anuncioId = \Input::get('anuncio_id');


			// Si la denuncia es verdadera se bloquea el anuncio y se abre un historial al denunciado
			// Igualmente se abre un historial al denunciante para incrementar las denuncias verdaderas realizadas
		
			# historial para el denunciado, sus anuncios bloqueados incrementan
			$historialDenunciado = $this->historialRepo->nuevoHistorial(\Input::get('denunciado_id'));
			$historialDenunciado->anunciosbloqueados++;
			$this->historialRepo->save($historialDenunciado);

			# historial para el denunciante, sus denuncias verdaderas incrementan
			$historialDenunciante = $this->historialRepo->nuevoHistorial(\Input::get('denunciante_id'));
			$historialDenunciante->denunciasverdaderas++;
			$this->historialRepo->save($historialDenunciante);		

			
			

			if ($this->anuncioRepo->bloquearAnuncio($anuncioId , \Auth::id()))
			{
				
				

				# se elimina la denuncia una vez se ha revisado y gestionado
				$this->denunciaRepo->eliminarDenunciaTipoAnuncio($anuncioId);



				/* actualizar historial de anuncio */
				# se envía: id del anuncio, id de política, los atributos a guardar
				//dd(\Input::all());
				$this->actualizarHistorialAnuncio($anuncioId, \Input::get('politica_id'), \Input::all());
				//dd('fafa');

				# se requiere la configuracion del sistema para conocer los anuncios bloqueados permitidos
				$configuracion = $this->configuracionRepo->cargarConfiguracionActual();
				$anunciosBloqueadosPermitidos = $configuracion->anunciosbloqueados;

				# si los anuncios bloqueados del denunciado es >= que anuncios bloqueados permitidos, se bloquea denunciado 
				if ($historialDenunciado->anunciosbloqueados >= $anunciosBloqueadosPermitidos){
					$this->cuentaRepo->bloquearCuenta($historialDenunciado->usuario_id);
				}

				\DB::commit();

				return \Redirect::route('admin.revisar.denuncias')->with('status_ok', 
																		'Anuncio revisado y bloqueado correctamente');
			}
			return \Redirect::route('admin.revisar.denuncias')->with('status_error', 
																		'No se pudo bloquear el anuncio');
		}
		catch(\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}	
	}

	public function actualizarHistorialAnuncio($anuncioId, $politicaId,  $atributos)
	{
		$historialAnuncio = $this->historialanuncioRepo->nuevoHistorialAnuncio($anuncioId);

		$historialAnuncio->usuario_id = \Auth::id();
		$historialAnuncio->politica_id = $politicaId;

		$managerhistorial = new HistorialanuncioManager($historialAnuncio, $atributos);	 	
		$managerhistorial->save();
	}

	/* Rechaza la denuncia sobre el anuncio */
	public function rechazarDenuncia(){
		try 
		{
			\DB::beginTransaction();

			// Si la denuncia es falsa se reactiva el anuncio y se abre un historial al denunciante
			// Se abre el historial al denunciante para incrementar sus denuncias falsas

			# historial para el denunciante, sus denuncias falsas incrementan
			$historialDenunciante = $this->historialRepo->nuevoHistorial(\Input::get('denunciante_id'));
			$historialDenunciante->denunciasfalsas++;
			$this->historialRepo->save($historialDenunciante);

			$admin = \Auth::id();
			$anuncio_id = \Input::get('anuncio_id');

			if ($this->anuncioRepo->reactivarAnuncio($anuncio_id)){

				# se elimina la denuncia una vez se ha revisado y gestionado
				$this->denunciaRepo->eliminarDenunciaTipoAnuncio($anuncio_id);
				
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

				return \Redirect::route('admin.revisar.denuncias')->with('status_ok', 
																		'Anuncio revisado y activado correctamente');
			}

			return \Redirect::route('admin.revisar.denuncias')->with('status_error', 
																	 'No se pudo reactivar el anuncio');
		}
		catch (\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}																	
	}
}
