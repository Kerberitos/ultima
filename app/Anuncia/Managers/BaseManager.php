<?php namespace Anuncia\Managers;

abstract class BaseManager
{
	protected $entidad;
	protected $data;
	protected $errores;
	
	public function __construct($entidad, $data)
	{
		$this->entidad = $entidad;
		$this->data = array_only(
							$data, 
							array_keys($this->getRules())
					  );
	}
	
	abstract public function getRules();
	
	public function getErrores()
	{
		return $this->errores;
	}

	public function isValid()
	{
		$rules=$this->getRules();
		$validation= \Validator::make($this->data, $rules);
		$isValid=$validation->passes();
		$this->errores=$validation->messages();
		
		return $isValid;
	}

	public function save()
	{
		if(! $this->isValid())
		{
			return false;
		}
		
		$this->entidad->fill($this->data);
		$this->entidad->save();
		
		return true;
	}
	
	public function simpleSave()
	{
		$this->entidad->fill($this->data);
		$this->entidad->save();
		
		return true;
	}
}

