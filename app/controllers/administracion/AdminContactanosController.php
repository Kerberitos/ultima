<?php namespace administracion;

use Anuncia\Repositorios\IncidenteRepo;
use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\CuentaRepo;
use Anuncia\Repositorios\ConfiguracionRepo;

use Anuncia\Asistentes\Cartero;

/**
 * ----------------------------------------------------
 * Clase que permite a un Administrador: 
 * 		- Gestionar los mensajes recibidos mediante contáctanos
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

class AdminContactanosController extends \BaseController
{
	protected $usuarioRepo;
	protected $cuentaRepo;
	protected $incidenteRepo;
	protected $configuracionRepo;

	public function __construct(IncidenteRepo $incidenteRepo,
								UsuarioRepo $usuarioRepo,
								CuentaRepo $cuentaRepo,
								ConfiguracionRepo $configuracionRepo)
	{
		$this->incidenteRepo= $incidenteRepo;
		$this->usuarioRepo=$usuarioRepo;
		$this->cuentaRepo=$cuentaRepo;
		$this->configuracionRepo=$configuracionRepo;
	}

	/* Muestra una lista de los mensajes recibidos mediante contáctanos */
	public function mostrarMensajesContactanos()
	{
		$usuario = \Auth::user()->usuario;

		$anuncios = $this->incidenteRepo->mensajesIncidentes($usuario->rol_id);
		return \View::make('modulos.administracion.vermensajescontactanos', 
							compact('anuncios')
				);
	}

	/* Ver el mensaje contactanos de manera individual */
	public function revisarMensajeContactanos($id)
	{
		$mensaje = $this->incidenteRepo->buscarMensaje($id);
		$this->notFoundUnLess($mensaje);

		# admin es requerido si el mensaje contactanos ya está siendo revisado por un administrador
		$admin = \Auth::id();

		if(\Helper::compararCadenas($mensaje->estatus_visto, "libre"))
		{

			$this->incidenteRepo->estatusRevisionOcupado($mensaje, $admin);

			return \View::make('modulos.administracion.revisionmsmcontactanos', 
								compact('mensaje')
					); 
		}
		else if (\Helper::compararCadenas ($mensaje->estatus_visto, "ocupado") & ($mensaje->admin == $admin))
		{
			return \View::make('modulos.administracion.revisionmsmcontactanos', 
								compact('mensaje')
					); 

		}
		else if (\Helper::compararCadenas ($mensaje->estatus_visto, "ocupado") & ($mensaje->admin != $admin))
		{
			return \Redirect::route('admin.msmcontactanos')->with('status_error', 
																  'Este mensaje ya lo está revisando otro administrador.');
		}
		else
		{
			return \Redirect::route('admin.msmcontactanos')->with('status_error', 
																  'Ese mensaje no ha solicitado revision.');
		}
	}

	/** 
	* Verifica si existe algun usuario registrado asociado al correo proporcionado desde contactanos 
	* Muestra información de la cuenta de usuario y las acciones de administrador sobre el mensaje
	*/
	public function verificarCuenta($id)
	{
		$mensaje = $this->incidenteRepo->buscarMensaje($id);
		$this->notFoundUnLess($mensaje);
		
		$correo = $mensaje->correo;
		
		$cuenta = $this->cuentaRepo->buscarCuentaCorreo($correo);

		// Si existe cuenta
		if (! empty($cuenta))
		{
			$configuracionActual =  $this->configuracionRepo->cargarConfiguracionActual();
			$usuario = $cuenta->usuario;

			return \View::make('modulos.administracion.ververificarcuenta', 
								compact('cuenta', 'usuario', 'mensaje', 'configuracionActual')
					);
		}
		
		return \Redirect::back()->with('status_error', 
										  'El correo brindado por el usuario, no se encuentra 
										   asociado a ninguna cuenta en el sistema');
			
	}

	/* Elimina mensaje contactanos */
	public function eliminarMensajeContactanos($mensajeId)
	{
		$mensaje = $this->incidenteRepo->buscarMensaje($mensajeId);
		$this->notFoundUnLess($mensaje);
		
		$rolAdmin = \Auth::user()->usuario->rol_id;

		if($rolAdmin == 2 | $rolAdmin == 3)
		{
			if($this->incidenteRepo->eliminarMensaje($mensaje))
			{
				return \Redirect::to('admin/mensajes-contactanos')->with('status_ok',
																	     'El mensaje ha sido eliminado de sugerencias ');
			}
			return \Redirect::to('admin/mensajes-contactanos')->with('status_error',
																	 'El mensaje no pudo ser eliminado de sugerencias ');
		}
		
		return	\App::abort(404);
	}

	/* Envia respuesta a usuario que escribió desde contactanos */
	public function responderContactanos($usuarioId, $mensajeId)
	{
		try
		{
			\DB::beginTransaction();

			$usuario = $this->usuarioRepo->buscarUsuario($usuarioId);
			$this->notFoundUnLess($usuario);

			$estadocuenta = $usuario->cuenta->estado->estado;
			$motivo = '';
			
			# cartero enviara el correo electrónico
			$cartero = new Cartero();
			
			# se requiere la configuracion del sistema para realizar comparaciones
			$configuracion = $this->configuracionRepo->cargarConfiguracionActual();
			
			if ($estadocuenta == "bloqueado")
			{
				if ($usuario->historial)
				{
					$contadorDeDenunciasUsuario = $usuario->historial->denunciasfalsas - $usuario->historial->denunciasverdaderas;
					$anunciosBloqueadosUsuario = $usuario->historial->anunciosbloqueados;
					$comentariosEliminadosUsuario = $usuario->historial->comentarioseliminados;

					if ( $anunciosBloqueadosUsuario >= $configuracion->anunciosbloqueados )
					{
	                	$respuesta = $usuario->nombres.' su cuenta de usuario en Miradita Loja se encuentra bloqueada, 
	                								debido a que superó el número de anuncios bloqueados permitidos	                								anuncios bloqueados.';

	                }
	                else if ($contadorDeDenunciasUsuario >=	$configuracion->contadordedenuncias)
	                {
	                	$respuesta = $usuario->nombres.' su cuenta de usuario en Miradita Loja se encuentra bloqueada, 
	                									 debido a que abusó del sistema de denuncias, realizando denuncias
	                									 falsas repetida e innecesariamente.';
	                
	                }
	                else if ($comentariosEliminadosUsuario >= $configuracion->comentarioseliminados)
	                {
	               		$respuesta = $usuario->nombres.' su cuenta de usuario en Miradita Loja se encuentra bloqueada, 
	               										 debido a que superó el número de comentarios bloqueados permitidos';
	               	}
				}
			}
			else if ($estadocuenta == "desactivado")
			{
				$respuesta = $usuario->nombres.' su cuenta de usuario en Miradita Loja se encuentra desactivada, en el 
												 momento que se registró un mensaje fue enviado a su correo
												 electrónico, por favor si no encuentra el mensaje en su bandeja de entrada
												 revise en correo no deseado (spam), o puede solicitar un nuevo enlace de activación.';
			}
			
			/* Envía un correo electrónico con la respuesta */
			if($cartero->cartaRespuestaContactanos($usuario, $respuesta, $estadocuenta))
			{
				# eliminar mensaje contactanos gestionado
				$this->eliminarMensajeContactanos($mensajeId);
				
				\DB::commit();

				return \Redirect::to('admin/mensajes-contactanos')->with('status_ok',
																		'El correo electrónico fue enviado correctamente y 
																		 el mensaje que revisó fue procesado.');
			}

			return \Redirect::to('admin/mensajes-contactanos')->with('status_error',
																	'La respuesta no se pudo enviar');
		}
		catch(\Exception $ex)
		{
			\DB::rollback();
			\Session::flash('error_de_servidor',1);
			return \Redirect::back();
		}	
	}
}