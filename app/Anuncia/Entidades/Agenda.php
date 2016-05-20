<?php namespace Anuncia\Entidades;

class Agenda extends \Eloquent
{
	protected $table = 'agendas';

	protected $fillable = array(
		'nota',
	);

	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}
	
	public function setCelularAttribute($value)
	{
		if (! empty ($value))
		{
			$this->attributes['celular'] = \Crypt::encrypt($value);
		}
	}

	public function getCelularAttribute($value)
	{
		if (! empty ($value))
		{
			return \Crypt::decrypt($value);
		}
	}

	public function setTelefonoAttribute($value)
	{
		if (! empty ($value))
		{
			$this->attributes['telefono'] = \Crypt::encrypt($value);
		}
	}

	public function getTelefonoAttribute($value)
	{
		if (! empty ($value))
		{
			return  \Crypt::decrypt($value);
		}
	}
}