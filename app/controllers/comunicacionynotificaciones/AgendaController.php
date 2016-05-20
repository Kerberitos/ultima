<?php namespace comunicacionynotificaciones;

use Anuncia\Managers\AgendaManager;

use Anuncia\Repositorios\AgendaRepo;
use Anuncia\Repositorios\AnuncianteRepo;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Gestionar la Agenda de usuario
 * ----------------------------------------------------
 * Rutas:
 * 		- miradita/app/routes/auth.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class AgendaController extends \BaseController
{
	protected $agendaRepo;
	protected $anuncianteRepo;

	public function __construct(AgendaRepo $agendaRepo,
								AnuncianteRepo $anuncianteRepo)
	{
		$this->agendaRepo = $agendaRepo;
		$this->anuncianteRepo = $anuncianteRepo;
	}

	/* Visualiza la agenda de usuario con los contactos*/
	public function mostrarMiAgenda()
	{
		$busqueda = trim(\Input::get('busqueda'));
		$textobuscado = "";

		$usuario_id = \Auth::id();
		
		if ($busqueda == "")
		{
			// si el input de busqueda está vacio no es necesario realizar acciones 
		}
		else if ($busqueda != "")
		{
			$textobuscado = $busqueda;
			$contactos = $this->agendaRepo->busquedaContactosPorNombres($busqueda, $usuario_id);

			# sizeof devuelve el tamaño del argumento recibido
			if (sizeof($contactos) == 0)
			{
				return \Redirect::route('miagenda')->with('status_nohaycoincidencias',
														    'No hay resultados de búsqueda
															para '.$textobuscado);
			}
			
			return \View::make('modulos.comunicacionynotificaciones.miagenda', 
							compact('contactos', 'textobuscado')
				);

		}

		$contactos = $this->agendaRepo->cargarAgenda($usuario_id);
		
		return \View::make('modulos.comunicacionynotificaciones.miagenda', 
							compact('contactos', 'textobuscado')
				);
	}

	/* Muestra información del contacto de forma individual */
	public function verContacto($id)
	{
		$contacto = $this->agendaRepo->buscarContactoId($id);
		$this->notFoundUnLess($contacto);



		if ($this->perteneceContacto($contacto->usuario_id))
		{
			return \View::make('modulos.comunicacionynotificaciones.vercontacto', 
								compact('contacto')
					);	
		}
		
		return \App::abort(404);
	}

	/* Verifica si el contacto pertenece al usuario que solicita alguna acción*/
	public function perteneceContacto($usuarioDeAgenda)
	{
		$usuarioActual = \Auth::id();
		
		if ($usuarioDeAgenda == $usuarioActual)
		{
			return true;
		}
		return false;
	}


	/* Agrega contacto a la agenda */
	public function agregarContactoAgenda()
	{
		$anuncianteId = \Input::get('anunciante_id');

		$contacto = $this->agendaRepo->buscarContactoPorAnunciante($anuncianteId);

		if ($this->existe($contacto))
		{
			return \Redirect::back()->with('agendar_error',
										   'El anunciante ya se encuentra agendado');
		}
		
		$anunciante = $this->anuncianteRepo->buscarAnuncianteId($anuncianteId);
		
		if ($this->existe($anunciante))
		{
			$agenda = $this->agendaRepo->nuevaAgenda(\Auth::id());
			$manageragenda = new AgendaManager($agenda, \Input::all());

			if ($manageragenda->isValid())
			{

				$agenda->nombre = $anunciante->anunciante;
				$agenda->celular = $anunciante->celular;
				$agenda->telefono = $anunciante->telefono;
				$agenda->anunciante_id = $anuncianteId;
				$agenda->nota =  \Helper::purificarCadena(\Input::get('nota'));

				$manageragenda->save();

				return \Redirect::back()->with('agendar_ok',
											   'Anunciante agendado correctamente');
			}
			
			return \Redirect::back()->withInput()->withErrors($manageragenda->getErrores())->with('agendar_error',
																						'Hubo un problema, no se 
																						 pudo agendar anunciante');
		}
		
		return \View::make('mensajes.anuncionodisponible');
	} 

	/* Verifica si existe el objeto */
	public function existe($objeto)
	{
		if(!empty($objeto))
		{
			return true;
		}
		
		return false;
	}

	/* Elimina contacto de agenda*/
	public function eliminarContactoAgenda($contacto_id)
	{
		$contacto = $this->agendaRepo->buscarContactoId($contacto_id);
		$this->notFoundUnLess($contacto);

		if ($contacto->usuario_id == \Auth::id())
		{
			if ($this->agendaRepo->eliminarContacto($contacto))
			{
				return  \Redirect::route('miagenda')->with( 'agendar_ok',
															'Contacto eliminado correctamente');
			}
			return  \Redirect::route('miagenda')->with( 'agendar_error',
														'Contacto no pudo ser eliminado');
		}
		
		return \App::abort(404);
	}
}
