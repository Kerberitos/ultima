<?php namespace Anuncia\Entidades;

class Anunciante extends \Eloquent
{
	protected $table = 'anunciantes';
	
	protected $fillable = array(
		'anunciante',
		'compania_id',
		'correo',
		'celular',
		'telefono',
		'tipopersona',
		'whatsapp',
	);

	public function anuncio()
	{
    	return $this->belongsTo('Anuncia\Entidades\Anuncio');
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

	public function getCompaniaIdTitleAttribute()
	{
		if ($this->compania_id==2)
		{
			return 'Movistar';
		}
		else if ($this->compania_id==3)
		{
			return 'Claro';
		}
		else if ($this->compania_id==4)
		{
			return 'Cnt';
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

	public function getTipoPersonaTitleAttribute()
	{
		if ($this->tipopersona=="negocio")
		{
			return 'Es empresa o negocio';
		}
		else if ($this->tipopersona=="particular") 
		{
			return 'Es particular';
		}
	}
	
	public function getWhatsappTitleAttribute()
	{
		if ($this->whatsapp==0)
		{
			return 'NO';
		}
		else if ($this->whatsapp==1)
		{
			return 'SI';
		}
	}
}