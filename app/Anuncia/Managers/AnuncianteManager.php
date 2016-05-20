<?php namespace Anuncia\Managers;

class AnuncianteManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'anunciante' => 'required|alpha_spaces',
			'celular' => 'required|numeric|digits:10',
			'compania_id' => 'required',
			'telefono' => 'numeric|digits_between:6,9',
			'tipopersona' => 'required',
			'whatsapp' => 'required',
		];

		return $rules;
	}
}