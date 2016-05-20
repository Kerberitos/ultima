<?php namespace Anuncia\Managers;

class SimpleValidadorManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'correo'=>'required|email|unique:usuarios,correo',
		];
		
		return $rules;
	}
}