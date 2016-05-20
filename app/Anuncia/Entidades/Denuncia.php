<?php namespace Anuncia\Entidades;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class Denuncia extends \Eloquent
{
	protected $table = 'denuncias';
	
	protected $fillable = array(
		'denunciado_id',
		'politica_id',
		'identificativo',
		'justificacion',
	);

	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}

	public function politica()
	{
		return $this->belongsTo('Anuncia\Entidades\Politica');
	}

	public function getCreatedAtAttribute($value)
	{
		return new Date($value);
	}
}