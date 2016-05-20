<?php namespace Anuncia\Managers;

class CuentaManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'correo' => 'required|email|unique:cuentas,correo',
			'password' => 'required|confirmed|min:8',
			'password_confirmation' => 'required',
			
		];
		
		return $rules;
	}
}