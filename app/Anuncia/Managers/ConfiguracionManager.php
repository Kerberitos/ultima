<?php namespace Anuncia\Managers;

class ConfiguracionManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'anunciosadministrador' => 'required|numeric|min:3|max:100',
			'anunciosusuario' => 'required|numeric|min:3|max:50',
			'anunciosbloqueados' => 'required|numeric|min:3|max:20',
			'comentariosbloqueados' => 'required|numeric|min:3|max:20',
			'contadordedenuncias' => 'required|numeric|min:3|max:50',
			'solicitudes' => 'required',
		];
		
		return $rules;
	}
}