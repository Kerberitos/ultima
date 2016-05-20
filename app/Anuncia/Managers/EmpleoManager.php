<?php namespace Anuncia\Managers;

class EmpleoManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'categoria_id' => 'required',
			'descripcion' => 'required|min:30|max:500',
			'pregunta' => 'required',
			'seccion_id' => 'required',
			'subcategoria_id' => 'required',
			'tipo' => 'required',
			'titulo' => 'required|min:30|max:100',
			'valor' => 'required|numeric',
		];
		
		return $rules;
	}
}