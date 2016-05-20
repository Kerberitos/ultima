<?php namespace Anuncia\Managers;

class ComentarioManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'anuncio_id' => 'required',				
			'comentario' => 'required|min:10|max:150',
		];
		
		return $rules;
	}
}