<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Cuenta;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class CuentaRepo extends BaseRepo
{

	public function getModel()
	{
		return new Cuenta;	
	}

	public function nuevaCuenta($acccion)
	{
		$cuenta = new Cuenta();

		# conectar cuando se desea registrar meediante una red social
		if($acccion == 'conectar')
		{
			$cuenta->estado_id = 1;
			$cuenta->bandera_social = true;
		}
		else
		{
			$cuenta->estado_id = 2;
			$cuenta->bandera_social = false;		
		}

		$cuenta->random = uniqid('mir_',true);
		
		$cuenta->nav_avanzada = false;

		return $cuenta;
	}

	/* *Busca cuenta por su correo */
	public function buscarCuentaCorreo($correo)
	{
		return Cuenta::whereCorreo($correo)->first();
	}

	/* *Busca cuenta por medio de random (token de activación) */
	public function buscarCuentaRandom($random)
	{
		return Cuenta::whereRandom($random)->first();
	}

	/* *Busca usuairo por id y por random (TOKEN de verificación) */
	public function buscarCuentaRandomId($id, $random)
	{
		$cuenta = Cuenta::whereRandom($random)->first();
		
		/* Si id de la cuenta coincide con el id enviado desde el correo, retorna la cuenta */
		if (! empty($cuenta))
		{
			# comprueba si id coincide con id de cuenta almacenado
			if ($id == $cuenta->id)
			{
				return $cuenta;		
			}	
		}

		return null;
	}

	/* *Busca cuenta por id de la red social */
	public function buscarCuentaPorSocialId($socialId)
	{
		return Cuenta::where('social_id', $socialId)->first();	
	}

	/*	*Cambia estado de una cuenta a  activado */
	public function activarCuenta($cuenta)
	{
		# estado 1 = activado
		$cuenta->estado_id = 1;
		$cuenta->save();
	}

	/* *Indica que usuario ha ingresado con una red social */
	public function activarBanderaSocial($cuenta)
	{
		$cuenta->bandera_social = true;
		$cuenta->save();
	}

	/* *Guarda social id de usuario*/
	public function guardarSocialId($cuenta, $socialId)
	{
		$cuenta->social_id = $socialId;
		$cuenta->save();
	}

	/* *Devuelve todas las cuentas desactivadas */
	public function cuentasDesactivadas()
	{
		return Cuenta::where('estado_id','=', 2)->paginate(6);
	}

	/* *Devuelve número total de cuentas desactivadas */
	public function enumerarCuentasDesactivadas()
	{
		return Cuenta::where('estado_id','=', 2)->count();
	}

	
	/* *Devuelve todas las cuentas bloqueadas */
	public function cuentasBloqueadas()
	{
		return Cuenta::where('estado_id','=',3)->paginate(6);
	}

	/* *Devuelve número total de cuentas bloqueadas */
	public function enumerarCuentasBloqueadas()
	{
		return Cuenta::where('estado_id','=',3)->count();	
	}

	/* *Devuelve todas las cuentas activas */
	public function cuentasActivas()
	{
		return Cuenta::where('estado_id','=', 1)->paginate(6);
	}

	/* *Devuelve número total de cuentas bloqueadas */
	public function enumerarCuentasActivas()
	{
		return Cuenta::where('estado_id','=',1)->count();	
	}


	/* *Busca cuentas de usuarios por Correo y por su estado */
	public function busquedaCuentasPorCorreoEstado($busqueda, $estado)
	{
		return  Cuenta::where('estado_id', '=', $estado)->where(function($query) use($busqueda) {
                $query->where('correo', 'like', '%'.$busqueda.'%');
            })->paginate(6);
	}
	/* *Bloquea cuenta de usuario*/
	public function bloquearCuenta($cuentaId)
	{
		$cuenta = Cuenta::find($cuentaId);
		$cuenta->estado_id = 3;
		$cuenta->save();

		return true;
	}

	/* *Activa cuenta de usuario*/
	public function desbloquearCuenta($cuentaId)
	{
		$cuenta = Cuenta::find($cuentaId);
		$cuenta->estado_id = 1;
		$cuenta->save();

		return true;
	}


}