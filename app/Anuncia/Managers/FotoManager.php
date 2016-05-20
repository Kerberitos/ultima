<?php namespace Anuncia\Managers;

class FotoManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'fotoperfil' => 'mimes:jpeg,jpg,png|max:3000',
		];
		
		return $rules;
	}
}