<?php namespace Anuncia\Managers;

class UsuarioManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'genero' => 'required',
			'nombres' => 'required|min:8|max:30|alpha_spaces',
			'politicas' => 'required',
		];
		
		return $rules;
	}
}