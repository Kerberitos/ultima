<?php namespace Anuncia\Managers;

class CorreoSimpleManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'correo' => 'required|email',
		];
		
		return $rules;
	}
}