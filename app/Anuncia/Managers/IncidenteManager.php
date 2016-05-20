<?php namespace Anuncia\Managers;

class IncidenteManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'nombres' => 'required|min:8|max:30|alpha_spaces',
			'correo' => 'required|email',
			'motivo' => 'required',
			'mensaje' => 'required|min:20|max:150',
			'g-recaptcha-response' => 'required',
		];
		
		return $rules;
	}
}