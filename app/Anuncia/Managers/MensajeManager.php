<?php namespace Anuncia\Managers;

class MensajeManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'anuncio_id' => 'required',
			'usuario_id' => 'required',
			'mensaje' => 'required|min:10|max:150',
			'mensaje_previo' => 'required|max:150',
		];
		
		return $rules;
	}
}