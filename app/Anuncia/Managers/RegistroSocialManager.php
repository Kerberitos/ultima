<?php namespace Anuncia\Managers;

class RegistroSocialManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'social_id' => '',
			'nombres' => '',
			'correo' => '',
			'genero' => '',
			
		];
		
		return $rules;
	}
}