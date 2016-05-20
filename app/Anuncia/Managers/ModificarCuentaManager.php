<?php namespace Anuncia\Managers;

class ModificarCuentaManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'correo' => 'required|email|unique:cuentas,correo,'.$this->entidad->id
		];
		
		return $rules;
	}
}