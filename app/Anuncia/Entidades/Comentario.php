<?php namespace Anuncia\Entidades;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class Comentario extends \Eloquent
{
	protected $table = 'comentarios';

	protected $fillable = array(
		'anuncio_id',
	);

	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}

	public function respuestas()
    {
        return $this->hasMany('Anuncia\Entidades\Respuesta');
    }
	
	public function anuncio()
	{
		return $this->belongsTo('Anuncia\Entidades\Anuncio');
	}

	public function getCreatedAtAttribute($value)
	{
	    return new Date($value);
	}
}