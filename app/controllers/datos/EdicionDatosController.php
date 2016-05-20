<?php namespace datos;

use Anuncia\Entidades\Compania;

use Anuncia\Managers\ModificarDatosManager;

/**
 * ----------------------------------------------------
 * Clase que permite: 
 * 		- Editar los datos generales de usuario
 * ----------------------------------------------------
 * Rutas:
 *
 *		- miradita/app/routes/auth.php
 *		
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class EdicionDatosController extends \BaseController
{
	/* Muestra formulario para editar datos de usuario */
	public function getEditarDatos($slug)
	{
		$usuario = \Auth::user()->usuario;


		
		# compañias de celulares: Claro, Movistar, CNT
		// no hacer esto, código sucio, obligado a realizar para evitar crear una nueva clase Repositorio
		$companias = Compania::orderBy('nombre','asc')->get()->lists('nombre','id');

		return \View::make('modulos.datos.editardatos', compact('usuario', 'companias'));
	}
	
	

	/* Procesa formulario editar datos */
	public function postEditarDatos($slug)
	{
		# compania de celular	
		$compania = 0;

		# usuario logueado
		$usuario = \Auth::user()->usuario;
		
		# alamcena los datos a guardar
		$datos = [];

		// Si el campo celular no está vacio
		if (\Input::get('celular')!="")
		{
			// si no asigna una compania de celular
			if(\Input::get('compania_id')=="")
			{
				return \Redirect::back()->with('error_compania',
											   'Debe seleccionar una compania');;
			}
			$compania = \Input::get('compania_id');
		}

		// Nunca ha cambiado de nombre el usuario
		if ( $usuario->cambio == false )
		{
			$nuevoNombre = trim(\Input::get('nombres'));

			// Se puede cambiar el nombre una sola vez en el sistema
			# compara si el nombre ha cambiado 
			if (! (\Helper::compararCadenas($usuario->nombres, $nuevoNombre)))
			{
				$usuario->cambio = true;
				$usuario->slug = \Str::slug($nuevoNombre);
			}

			//$datos = array_map('trim', \Input::all());

			$datos = [
				'nombres' => $nuevoNombre,
				'genero' => \Input::get('genero'),
				'telefono' => trim(\Input::get('telefono')),
				'celular' => (\Input::get('celular')),
				'compania_id' =>  $compania,
			];
		}
		else
		{
			// Ha cambiado nombre el usuario alguna vez
			$datos = [
				'nombres' => $usuario->nombres,
				'genero' => \Input::get('genero'),
				'telefono' => trim(\Input::get('telefono')),
				'celular' => (\Input::get('celular')),
				'compania_id' =>  $compania,
			];
		}

		$manager = new ModificarDatosManager($usuario, $datos);

		if($manager->save())
		{
			return \Redirect::route('perfil',[$usuario->slug ])->with('cambio_correcto', 
																	  'Su información general 
																	   se ha modificado 
																	   correctamente');
		}
		
		return \Redirect::back()->withInput()->withErrors($manager->getErrores());
	}
	
}
