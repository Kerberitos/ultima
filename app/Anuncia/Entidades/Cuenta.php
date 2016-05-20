<?php namespace Anuncia\Entidades;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class Cuenta extends \Eloquent implements UserInterface, RemindableInterface 
{
	use UserTrait, RemindableTrait;
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cuentas';

	protected  $fillable=array(
		'correo',
		'password',
		'estado_id',
		'social_id',
	);

	/* *Relación con usuario*/
	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}

	/* *Relación con estado */
	public function estado()
	{
		return $this->belongsTo('Anuncia\Entidades\Estado');
	}







	public function getCreatedAtAttribute($value)
	{
	    return new Date($value);
	}



	public function setPasswordAttribute($value)
	{
		if (! empty ($value))
		{
			$this->attributes['password'] = \Hash::make($value);
		}
	}

	
}
