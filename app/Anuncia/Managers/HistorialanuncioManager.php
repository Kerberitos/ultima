<?php namespace Anuncia\Managers;

class HistorialanuncioManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			
			
			'accion' => 'required',
			'justificacion' => 'required|min:5|max:100',
		];
		
		return $rules;
	}
}