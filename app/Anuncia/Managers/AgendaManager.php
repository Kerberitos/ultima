<?php namespace Anuncia\Managers;

class AgendaManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			
			
			'nota' => 'min:5|max:50',
			
		];
		
		return $rules;
	}
}