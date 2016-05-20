<?php namespace Anuncia\Entidades;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class Notificacion extends \Eloquent
{
	protected $table = 'notificaciones';

	protected $fillable=array(
		
	);

	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}
	
	public function anunciante()
	{
		return $this->hasOne('Anuncia\Entidades\Anunciante');
	}

	public function getCreatedAtAttribute($value)
	{
		return new Date($value);
	}
}