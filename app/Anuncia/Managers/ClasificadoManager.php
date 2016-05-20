<?php namespace Anuncia\Managers;

class ClasificadoManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'categoria_id' => 'required',
			'descripcion' => 'required|min:30|max:500',
			'estado' => 'required',
			'foto1' => 'mimes:jpeg,jpg,png|max:4000',
			'foto2' => 'mimes:jpeg,jpg,png|max:4000',
			'foto3' => 'mimes:jpeg,jpg,png|max:4000',
			'foto4' => 'mimes:jpeg,jpg,png|max:4000',
			'opcionvalor' => 'required',
			'pregunta' => 'required',
			'seccion_id' => 'required',
			'subcategoria_id' => 'required',
			'titulo' => 'required|min:30|max:100',
			'valor' => 'required|numeric',
		];
		
		return $rules;
	}
		
}