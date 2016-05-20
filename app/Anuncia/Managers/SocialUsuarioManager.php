<?php namespace Anuncia\Managers;

class SocialUsuarioManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'nombres' => '',
			'genero' => '',
		];
		
		return $rules;
	}
}