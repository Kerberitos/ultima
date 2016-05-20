<?php namespace comunicacionynotificaciones;

use Anuncia\Managers\IncidenteManager;

use Anuncia\Repositorios\IncidenteRepo;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Enviar mensajes a través de Contáctanos
 * ----------------------------------------------------
 * Rutas:
 * 		- miradita/app/routes/basicas.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class ContactanosController extends \BaseController
{
	protected $incidenteRepo;

	public function __construct(IncidenteRepo $incidenteRepo)
	{
		$this->incidenteRepo=$incidenteRepo;
	}

	/* Visualiza el formulario Contáctanos*/
	public function verFormularioContactanos(){
		return \View::make('modulos.comunicacionynotificaciones.contactanos');
	}
		
	/* Envia mensaje desde contáctanos */
	public function enviarMensajeDesdeContactanos()
	{
		$incidente = $this->incidenteRepo->nuevoIncidente();

		$manager = new IncidenteManager($incidente, \Input::all());
	
		$incidente->mensaje =  \Helper::purificarCadena(\Input::get('mensaje'));

		# dependiendo del motivo rolreceptor almacena a quién va dirigido el mensaje 
		$rolreceptor = \Input::get('motivo');

		# Hacer sugerencias = motivo 1
		# Informar errores de funcionamiento = motivo 2
		# Otros = motivo 5
		if ($rolreceptor == 1 | $rolreceptor == 2 | $rolreceptor == 5)
		{
			# dirigido a Super administradores
			$incidente->receptor_rol = 3;
		}
		# No puedo activar mi cuenta = motivo 3
		# Mi cuenta está bloqueada = motivo 4
		else if ($rolreceptor == 3 | $rolreceptor == 4 )
		{
			# dirigido a Administradores
			$incidente->receptor_rol = 2;
		}	

		if ($manager->save())
		{
			return \Redirect::back()->with('status_ok',
										   'Su mensaje ha sido enviado correctamente');
		}
		return \Redirect::back()->withInput()->withErrors($manager->getErrores())->with('status_error',
																						'Su mensaje no ha sido 
																						enviado, verifique si 
																						lleno todos los campos ');
	}
}
