<?php namespace Anuncia\Managers;

class ServicioManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'categoria_id' => 'required',
			'descripcion' => 'required|min:30|max:500',
			'direccion' => 'max:100',
			'foto1' => 'mimes:jpeg,jpg,png|max:4000',
			'pregunta' => 'required',
			'seccion_id' => 'required',
			'subcategoria_id' => 'required',
			'titulo' => 'required|min:30|max:100',
		];
		
		return $rules;
	}
}