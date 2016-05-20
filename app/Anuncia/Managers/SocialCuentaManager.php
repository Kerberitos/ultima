<?php namespace Anuncia\Managers;

class SocialCuentaManager extends BaseManager
{
	public function getRules()
	{
		$rules = [
			'social_id' => '',
			'correo' => '',
		];
		
		return $rules;
	}
}