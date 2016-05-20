<?php namespace Anuncia\Asistentes;

use Anuncia\Entidades\Alerta;

use Anuncia\Repositorios\AlertaRepo;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Crear, actualizar alertas de usuarios
 * 
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */


class Secretario
{
	protected $alerta;
	protected $alertaRepo;

	public function __construct()
	{
		$this->alertaRepo = new AlertaRepo;
	}

	/* Crea o  incrementa alerta de cantidad de mensajes (nuevoMsm) */
	public function crearAlertaMensajes($usuarioId)
	{
		$this->alerta = $this->alertaRepo->buscarAlertasDeUsuario($usuarioId);
		
		
		if (! empty($this->alerta))
		{
			$this->alertaRepo->incrementarAlertaMensajes($this->alerta);
		}
		// si usuario no tiene alerta, crea nueva alerta
		else
		{
			$this->alerta = $this->alertaRepo->nuevaAlerta($usuarioId);

			$this->alertaRepo->incrementarAlertaMensajes($this->alerta);
		}
	}

	/* Actualiza alerta de cantidad de mensajes (actualizarMsm) */
	public function actualizarAlertaMensajes($usuarioId, $numeroDeMensajes)
	{
		$this->alerta = $this->alertaRepo->buscarAlertasDeUsuario($usuarioId);
		
		if(! empty($this->alerta))
		{
			$this->alertaRepo->actualizarAlertaMensajes($this->alerta, $numeroDeMensajes);
		}
		else
		{
			$this->alerta = $this->alertaRepo->nuevaAlerta($usuarioId);

			$this->alertaRepo->actualizarAlertaMensajes($this->alerta, $numeroDeMensajes);
		}		
	}

	/* Actualiza alerta de cantidad de notificaciones (actualizarMsm) */
	public function actualizarAlertaNotificaciones($usuarioId, $numeroDeNotificaciones)
	{
		$this->alerta = $this->alertaRepo->buscarAlertasDeUsuario($usuarioId);

		if(! empty($this->alerta))
		{
			$this->alertaRepo->actualizarAlertaNotificaciones($this->alerta, $numeroDeNotificaciones);
		}
		else
		{
			$this->alerta = $this->alertaRepo->nuevaAlerta($usuarioId);

			$this->alertaRepo->actualizarAlertaNotificaciones($this->alerta, $numeroDeNotificaciones);
		}		
	}
}