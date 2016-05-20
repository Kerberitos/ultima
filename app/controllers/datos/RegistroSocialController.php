<?php namespace datos;

//use Anuncia\Repositorios\RegistroSocialRepo;
use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\CuentaRepo;


use Anuncia\Managers\SocialUsuarioManager;
use Anuncia\Managers\SocialCuentaManager;

use Anuncia\Asistentes\Mensajero;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Ingresar a la aplicación web mediante redes sociales
 *
 * ----------------------------------------------------
 * Rutas:
 *
 *		- miradita/app/routes/guest.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class RegistroSocialController extends \BaseController
{
	# objeto que hara consultas a la entidad Usuario
	protected $usuarioRepo;
	protected $cuentaRepo;

	/* Constructor para asignar el repositorio que manipulará la entidad Usuario */
	public function __construct(UsuarioRepo $usuarioRepo,
								CuentaRepo $cuentaRepo)
	{
		$this->usuarioRepo = $usuarioRepo;
		$this->cuentaRepo = $cuentaRepo;
	}
	
	/* Ingreso mediante api de twitter*/
	public function ingresoTwitter()
	{


		# Obtener datos de entrada
		$token = \Input::get( 'oauth_token' );
		$verify = \Input::get( 'oauth_verifier' );
		
		# Obtener servicio de twitter
		$tw = \OAuth::consumer( 'Twitter' );
		
		/* Si se proporciona un código, obtener datos de usuario y abrir una sesión */
 		# Verifica si el codigo es valido (no está vacio)
 		if (! empty( $token ) && !empty( $verify )) 
 		{
			// Petición de devolución de llamada de Twitter, para obtener el token
			$token = $tw->requestAccessToken( $token, $verify );
		
			// Enviar una solicitud a twitter para verificar las credenciales ingresadas por usuario
			$result = json_decode( $tw->request( 'account/verify_credentials.json' ), true );
			
			$cuenta = $this->cuentaRepo->buscarCuentaPorSocialId($result['id']);

			$accion = 'conectar';


			/* Si cuenta existe*/
			# cuenta es diferente de null
			if (! empty($cuenta))
			{
				if ($cuenta->estado->estado == 'activado' | $cuenta->estado->estado == 'desactivado')
				{
					if ($cuenta->estado->estado == 'desactivado')
					{
						$this->cuentaRepo->activarCuenta($cuenta);
					}

					// Se crea una session de usuario para ingresar a la aplicación
					\Auth::login($cuenta);

					/* si cuenta no posee correo */
					if (empty($cuenta->correo))
					{
						// Redireccionamos para solicitar correo y genero
						return \Redirect::to('agregar/correo');
					}
					
					/* mostrar modal mensaje de bienvenida */
					return \Redirect::to('/')->with('ingreso_social', 'twitter');

				}
				// Si cuenta existe pero tiene estado de bloqueado o eliminado
				
				$estado = $cuenta->estado->estado;

				$mensaje= $this->obtenerMensaje($accion, $estado);

				// Muestra mensaje de estado de cuenta
				return \View::make('mensajes.mensajeestadocuenta', compact('mensaje'));	
			}
			
			
		
			/* Si no existe cuenta, se crea y registra */
			
			// carga la data con los valores devueltos del API de twitter
			# API de Twitter nunca devuelve correo
			$data = $this->cargarData($result);
		

		//$accion = 'conectar' ;

			// Creando el usuario para almacenar en la bd	
			$usuario = $this->usuarioRepo->nuevoUsuario($data);
			$cuenta = $this->cuentaRepo->nuevaCuenta($accion);

			// Crear managers 
			$managerUsuario = new SocialUsuarioManager($usuario, $data);
			$managerCuenta = new SocialCuentaManager($cuenta, $data);



			$managerUsuario->save();
			/* vincula usuario con su cuenta */	
			$cuenta->usuario_id = $usuario->id;
			$managerCuenta->save();

			// Se crea una session de usuario para ingresar a la aplicación
			\Auth::login($cuenta);
			
			// El api de twitter no retorna correo, así que solicitaremos al usuario un correo
			/* si usuario no posee correo */
			if (empty($cuenta->correo))
			{
			// Redireccionamos para solicitar correo y genero
				return \Redirect::to('agregar/correo');
			}
					
			return \Redirect::to('/')->with('ingreso_social', 'twitter');
		}
		# Verifica si el codigo no es valido (está vacio) redirecciona a pagina de twiiter login
		else 
		{
			// Obtener solicitud de token
			$reqToken = $tw->requestRequestToken();

			// Obtener autorización Uri enviando el token de solicitud
			$url = $tw->getAuthorizationUri(array('oauth_token' => $reqToken->getRequestToken()));
		
			// Redireccionar a url de twitter login
			return \Redirect::to( (string)$url );
		}
	} // fin ingreso con twiiter

	
	/* Ingreso mediante facebook */
	public function ingresoFacebook()
	{
			$code = \Input::get( 'code' );
			$fb = \OAuth::consumer( 'Facebook' );
			
			if (! empty( $code ))
			{
				$token = $fb->requestAccessToken( $code );
				$result = json_decode( $fb->request( '/me' ), true );
			
				# array_key_exists verifica si existe la llave email en el array
				if (array_key_exists('email', $result)) 
				{	
					$cuenta = $this->cuentaRepo->buscarCuentaCorreo($result['email']);
				}
				else
				{
					$cuenta = $this->cuentaRepo->buscarCuentaPorSocialId($result['id']);
				}

				$accion = 'conectar';

				/* Si cuenta existe*/
				# cuenta es diferente de null
				if (! empty($cuenta))
				{
					if ($cuenta->estado->estado == 'activado' | $cuenta->estado->estado == 'desactivado')
					{
						// Si nunca ha ingresado con facebook
						if ($cuenta->bandera_social == false)
						{
							$this->cuentaRepo->activarBanderaSocial($cuenta);
							$this->cuentaRepo->guardarSocialId($cuenta, $result['id']);
						}

						if ($cuenta->estado->estado == 'desactivado')
						{
							$this->cuentaRepo->activarCuenta($cuenta);
						}

						// Se crea una session de usuario para ingresar a la aplicación
						\Auth::login($cuenta);

						/* si cuenta no posee correo */
						if (empty($cuenta->correo))
						{
							// Redireccionamos para solicitar correo y genero
							return \Redirect::to('agregar/correo');
						}
						
						/* mostrar modal mensaje de bienvenida */
						return \Redirect::to('/')->with('ingreso_social', 'facebook');
					}
					
					// Si cuenta existe pero tiene estado de bloqueado o eliminado
					
					$estado = $cuenta->estado->estado;

					$mensaje = $this->obtenerMensaje($accion, $estado);

					// Muestra mensaje de estado de cuenta
					return \View::make('mensajes.mensajeestadocuenta', compact('mensaje'));	
				}

				// Si no existe cuenta se crea y registra

				// carga la data con los valores devueltos de API de facebook
				$data = $this->cargarData($result);
		
				// Creando el usuario para almacenar en la bd	
				$usuario = $this->usuarioRepo->nuevoUsuario($data);
				$cuenta = $this->cuentaRepo->nuevaCuenta($accion);

				// Crear managers 
				$managerUsuario = new SocialUsuarioManager($usuario, $data);
				$managerCuenta = new SocialCuentaManager($cuenta, $data);



				$managerUsuario->save();
				/* vincula usuario con su cuenta */	
				$cuenta->usuario_id = $usuario->id;
				$managerCuenta->save();

				// Se crea una session de usuario para ingresar a la aplicación
				\Auth::login($cuenta);
			
				// Si el api de facebook no retorna correo, solicitaremos al usuario un correo
				/* si usuario no posee correo */
				if (empty($cuenta->correo))
				{
				// Redireccionamos para solicitar correo y genero
					return \Redirect::to('agregar/correo');
				}
				/* mostrar modal mensaje de bienvenida */	
				return \Redirect::to('/')->with('ingreso_social', 'facebook');
		
			// if not ask for permission first
			}
			else 
			{
				# Verifica si el codigo no es valido (está vacio) redirecciona a pagina de login de facebook
				
				// get fb authorization
				$url = $fb->getAuthorizationUri();

				// return to facebook login url
				return \Redirect::to( (string)$url );
			}
	} // Fin ingreso con facebook
	




	/* Conecta con API de Google mediante cuenta de google+ */
	public function ingresoGoogle()
	{
		$code = \Input::get( 'code' );
		$googleService = \OAuth::consumer( 'Google' );
	
		if ( !empty( $code )) 
		{
			$token = $googleService->requestAccessToken( $code );
			$result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
		
			// unset($result['email']) método que sirvió para las pruebas, elimina un elemento de array;
			// unset($result['gender']);
			
			# array_key_exists verifica si existe la llave email en el array
			if (array_key_exists('email', $result)) 
			{	
				$cuenta = $this->cuentaRepo->buscarCuentaCorreo($result['email']);
			}
			else
			{
				$cuenta = $this->cuentaRepo->buscarCuentaPorSocialId($result['id']);
			}

			$accion = 'conectar';

			/* Si cuenta existe*/
			# cuenta es diferente de null
			if (! empty($cuenta))
			{
				if ($cuenta->estado->estado == 'activado' | $cuenta->estado->estado == 'desactivado')
				{
					// Si nunca ha ingresado con google+
					if ($cuenta->bandera_social == false)
					{
						$this->cuentaRepo->activarBanderaSocial($cuenta);
						$this->cuentaRepo->guardarSocialId($cuenta, $result['id']);
					}

					if ($cuenta->estado->estado == 'desactivado')
					{
						$this->cuentaRepo->activarCuenta($cuenta);
					}

					
					// Se crea una session de usuario para ingresar a la aplicación
					\Auth::login($cuenta);

					/* si cuenta no posee correo */
					if (empty($cuenta->correo))
					{
						// Redireccionamos para solicitar correo y genero
						return \Redirect::to('agregar/correo');
					}
					/* mostrar modal mensaje de bienvenida */	
					return \Redirect::to('/')->with('ingreso_social', 'google');
				}

				// Si cuenta existe pero tiene estado de bloqueado o eliminado
					
				$estado = $cuenta->estado->estado;

				$mensaje = $this->obtenerMensaje($accion, $estado);

				// Muestra mensaje de estado de cuenta
				return \View::make('mensajes.mensajeestadocuenta', compact('mensaje'));	
			}

			// Si no existe cuenta se crea y registra

			// carga la data con los valores devueltos de API de google+
			$data = $this->cargarData($result);
		
			// Creando el usuario y cuenta para almacenar en la bd	
			$usuario = $this->usuarioRepo->nuevoUsuario($data);
			$cuenta = $this->cuentaRepo->nuevaCuenta($accion);

			// Crear managers 
			$managerUsuario = new SocialUsuarioManager($usuario, $data);
			$managerCuenta = new SocialCuentaManager($cuenta, $data);



			$managerUsuario->save();
			/* vincula usuario con su cuenta */	
			$cuenta->usuario_id = $usuario->id;
			$managerCuenta->save();


			// Se crea una session de usuario para ingresar a la aplicación
			\Auth::login($cuenta);
			
			// Si el api de facebook no retorna correo, solicitaremos al usuario un correo
			/* si usuario no posee correo */
			if (empty($cuenta->correo))
			{
			// Redireccionamos para solicitar correo y genero
				return \Redirect::to('agregar/correo');
			}
			
			/* mostrar modal mensaje de bienvenida */		
			return \Redirect::to('/')->with('ingreso_social', 'google');
		
		// if not ask for permission first
		}
		else 
		{
			# Verifica si token no es valido (está vacio) redirecciona a pagina de login de google+
			// get googleService authorization
			$url = $googleService->getAuthorizationUri();

			// return to google login url
			return \Redirect::to( (string)$url );
		}
	} // fin ingreso con google
	
	/* Obtiene mensajes para informar si usuario está bloqueado o eliminado*/
	public function obtenerMensaje($accion, $estado){
		
		$peticion = array(
							'estado' => $estado,
							'accion' => $accion
					);

		$mensajero = new Mensajero($peticion);
		$mensaje = $mensajero->getMensaje();
		
		return $mensaje;
	}

	/* Devuelve array con todos los scopes (alcances) que devuelven las distinats APIs   */
	public function cargarData($resultado){

		$data = array();

		# array_key_exists verifica si existe la llave en un array
		if (array_key_exists('id', $resultado)) 
		{
			$data['social_id'] = $resultado['id'];
		}

		if (array_key_exists('name', $resultado)) 
		{
			$data['nombres'] = $resultado['name'];
		}

		if (array_key_exists('email', $resultado)) 
		{
			$data['correo'] = $resultado['email'];
		}

		if (array_key_exists('gender', $resultado)) 
		{
			$data['genero'] = $resultado['gender'];
		}

		return $data;
	}

}