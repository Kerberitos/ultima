<?php namespace Anuncia\Entidades;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class Historial extends \Eloquent
{
	protected $table = 'historiales';
	
	public function usuario(){
    	return $this->belongsTo('Anuncia\Entidades\Usuario');
    }

	public function getCreatedAtAttribute($value)
	{
		return new Date($value);
	}
}