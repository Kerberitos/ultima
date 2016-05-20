<?php namespace Anuncia\Entidades;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class Historialanuncio extends \Eloquent
{
	protected $table = 'historialanuncios';
	
	protected $fillable = array(
		
		'accion',
		'justificacion',
	);

	/*public function usuario(){
    	return $this->belongsTo('Anuncia\Entidades\Usuario');
    }*/
    public function politica()
	{
		return $this->belongsTo('Anuncia\Entidades\Politica');
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