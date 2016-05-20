<?php namespace Anuncia\Managers;

class ModificarDatosManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			
			'compania_id' => '',
			'genero' => '',
			'nombres' => 'alpha_spaces|min:8|max:31',
			'telefono' => 'numeric|digits_between:6,9',
			'celular' => 'numeric|digits:10',

			
			
			
		];
		
		return $rules;
	}
}