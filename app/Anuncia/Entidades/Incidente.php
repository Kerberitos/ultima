<?php namespace Anuncia\Entidades;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class Incidente extends \Eloquent
{
	protected $table = 'incidentes';
	
	protected $fillable = array(
		'correo',
		
		'motivo',
		'nombres',
	);

	public function getCreatedAtAttribute($value)
	{
		return new Date($value);
	}

	public function setCorreoAttribute($value)
	{
		if ( ! empty ($value))
		{
			$this->attributes['correo'] = \Crypt::encrypt($value);
		}
	}

	public function getCorreoAttribute($value)
	{
		if ( ! empty ($value))
		{
			return  \Crypt::decrypt($value);
		}
	}

	public function getMotivoTitleAttribute()
	{
		if ($this->motivo==1)
		{
			return 'Sugerencia';
		}
		else if ($this->motivo==2)
		{
			return 'Informar de error';
		}
		else if ($this->motivo==3)
		{
			return 'Mi cuenta desactivada';
		}
		else if ($this->motivo==4)
		{
			return 'Mi cuenta bloqueada';
		}else if ($this->motivo==5)
		{
			return 'Otro motivo';
		}
	}
}