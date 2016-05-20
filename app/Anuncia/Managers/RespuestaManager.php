<?php namespace Anuncia\Managers;

class RespuestaManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'respuesta' => 'required|min:10|max:150',
			'comentario_id' => 'required',
		];
		
		return $rules;
	}
}