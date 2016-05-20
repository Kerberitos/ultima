<?php namespace Anuncia\Managers;

class BajaCuentaManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'password' => 'required|min:3',
		];
		
		return $rules;
	}
}