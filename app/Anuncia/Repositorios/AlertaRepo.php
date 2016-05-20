<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Alerta;

class AlertaRepo extends BaseRepo
{
	
	public function getModel()
	{
		return new Alerta;	
	}
	
	public function nuevaAlerta($usuario_id)
	{
		$alerta = new Alerta();

		$alerta->usuario_id = (int)$usuario_id;

		return $alerta;
	}
	
	/* Busca alerta de usuario */
	public function buscarAlertasDeUsuario($usuario_id)
	{
		return Alerta::where('usuario_id','=', $usuario_id)->first();
	}

	/* Incrementa alerta de mensajes */
	/* addMsm */
	public function incrementarAlertaMensajes($alerta)
	{
		$alerta->msm = $alerta->msm + 1;
		$alerta->save();
	
		return true;
	}
	
	/* Actualiza alertas de mensajes */
	/* actualizarmsm */
	public function actualizarAlertaMensajes($alerta, $nuevoNumeroMensajes)
	{
		$alerta->msm = $nuevoNumeroMensajes;
		$alerta->save();
	
		return true;
	}

	/* Actualiza alertas de notificaciones */
	public function actualizarAlertaNotificaciones($alerta, $nuevaCantidadNotificaciones)
	{
		$alerta->notificacion = $nuevaCantidadNotificaciones;
		$alerta->save();
	
		return true;
	}
}
