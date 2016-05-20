<?php namespace Anuncia\Asistentes;


/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- enviar correos electrónicos
 * 
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class Cartero
{
    
	
    /* Envía un email con un enlace para activar cuenta posterior al registro */
	public function cartaRegistro($usuario)
	{
		$random = array(
				'random' => $usuario->cuenta->random,
		);

		
		
		//\Mail::queue('cartas.registro', $this->data2, function($message) use ($usuario)
		\Mail::send('cartas.registro', $random, function($message) use ($usuario)
		{
		
			
			//$madre="edison_rojas_leon@hotmail.com";
			// receptor y asunto del email enviado
			$message->to($usuario->cuenta->correo)->subject('Activar cuenta en Miradita Loja!');

		});
	}

	/* Envía un email con un nuevo enlace de activación de cuenta */
	public function cartaNuevoEnlace($usuario)
	{
		$credenciales = array(

				'random' => $usuario->cuenta->random,
				'id_usuario' => $usuario->id
		
		);
		
		\Mail::send('cartas.nuevoenlace', $credenciales, function($message) use ($usuario)
		{
			$message->to($usuario->cuenta->correo)->subject('Activar cuenta en Miradita Loja!');
		});
	}

	/* Envía un email con enlace para reactivar cuenta */
	public function cartaReactivacion($usuario)
	{
		$credenciales = array(

				'random' => $usuario->cuenta->random,
				'id_usuario' => $usuario->id

		);
				
		\Mail::send('cartas.reactivacion', $credenciales, function($message) use ($usuario)
		{
			$message->to($usuario->cuenta->correo)->subject('Reactiva tu cuenta en Miradita Loja!');
		});
	}

	/* Envía un email con indicaciones para recuperar contraseña olvidada */
	public function cartaRecuperacionPassword($usuario)
	{
		$credenciales = array(

				'random' => $usuario->cuenta->random,
				'id_usuario' => $usuario->id

		);
				
		\Mail::send('cartas.recuperacion', $credenciales, function($message) use ($usuario)
		{
			$message->to($usuario->cuenta->correo)->subject('Recuperar contraseña en Miradita Loja');
		});
	}

	/* Envía un email con respuesta atomatizada si cuenta de usuario está bloqueada o desactivada */
	public function cartaRespuestaContactanos($usuario, $motivo, $estado)
	{
		if ($estado == "bloqueado")
		{
			$credenciales = array(

					'estado' => 'bloqueada',
					'motivo' => $motivo
			
			);
		
			\Mail::send('cartas.respuestacontactanoscuentabloqueada', $credenciales, function($message) use ($usuario)
			{
				$message->to($usuario->cuenta->correo)->subject('Información sobre su cuenta en Miradita Loja');
			});

		}
		else if ($estado == "desactivado")
		{
			$credenciales = array(

					'estado' => 'desactivada',
					'motivo' => $motivo
			
			);
		
			\Mail::send('cartas.respuestacontactanoscuentadesactivada', $credenciales, function($message) use ($usuario)
			{
				$message->to($usuario->cuenta->correo)->subject('Información sobre su cuenta en Miradita Loja');
			});
		}
		
		return true;
	}
}