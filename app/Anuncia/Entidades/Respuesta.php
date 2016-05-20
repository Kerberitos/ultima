<?php namespace Anuncia\Entidades;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class Respuesta extends \Eloquent
{
	protected $table = 'respuestas';

	protected $fillable = array(
		'comentario_id',
	);

	public function comentario()
	{
		return $this->belongsTo('Anuncia\Entidades\Comentario');
	}
	
	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}

	public function getCreatedAtAttribute($value)
	{
	    return new Date($value);
	}
}