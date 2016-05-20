<?php namespace Anuncia\Entidades;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class Mensaje extends \Eloquent
{
	protected $table = 'mensajes';

	protected $fillable = array(
		'anuncio_id',
		'mensaje',
		'mensaje_previo',
		'usuario_id',
	);
	
	public function anunciante()
	{
		return $this->hasOne('Anuncia\Entidades\Anunciante');
	}

	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}
	
	public function getCreatedAtAttribute($value)
	{
	    return new Date($value);
	}

	public function getRemitenteRolTitleAttribute()
	{
		if ($this->remitente_rol=='U')
		{
			return 'Usuario';
		}
		else if ($this->remitente_rol=='A')
		{
			return 'Administrador';
		}
		else if ($this->remitente_rol=='S')
		{
			return 'Miradita Loja';
		}
	}

}