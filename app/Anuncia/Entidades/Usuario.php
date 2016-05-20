<?php namespace Anuncia\Entidades;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class Usuario extends \Eloquent  
{
	
	protected $table = 'usuarios';

	protected  $fillable=array(
		'celular',
		'compania_id',
		//'estado_id',
		'foto',
		'genero',
		'nombres',
		'telefono',
		
	);

	/* *relación de usuario con cuenta 1 a 1 */
	public function cuenta(){
		return $this->hasOne('Anuncia\Entidades\Cuenta');
	}

	/* *relación con postulante 1 a 1*/
    public function postulante(){
		return $this->hasOne('Anuncia\Entidades\Postulante');
	}

	/* *relación con anuncio 1 a Muchos */
	public function anuncios()
    {
        return $this->hasMany('Anuncia\Entidades\Anuncio');
    }





	public function alerta()
	{
		return $this->hasOne('Anuncia\Entidades\Alerta');
	}


	public function comentarios()
    {
        return $this->hasMany('Anuncia\Entidades\Comentario');
    }

    public function compania()
	{
		return $this->belongsTo('Anuncia\Entidades\Compania');
	}
  	
  	

    public function historial(){
		
		return $this->hasOne('Anuncia\Entidades\Historial');
	}

    public function notificaciones()
    {
        return $this->hasMany('Anuncia\Entidades\Notificacion')->orderBy('created_at', 'desc');
    }


    public function respuesta()
    {
        return $this->hasMany('Anuncia\Entidades\Respuesta');
    }

	public function getCreatedAtAttribute($value)
	{
	    return new Date($value);
	}



	/* *Encripta valor de celular  */
	public function setCelularAttribute($value)
	{
		if ( ! empty ($value))
		{
			$this->attributes['celular'] = \Crypt::encrypt($value);
		}
		else if (empty($value))
		{
			$this->attributes['celular'] = "";	
		}
	}

	/* *Obtiene y desencripta valor de celular  */
	public function getCelularAttribute($value)
	{
		if ( ! empty ($value))
		{
			//return $this->attributes['celular'] = \Crypt::decrypt($value);
			return \Crypt::decrypt($value);
		}
	}

	public function getGeneroTitleAttribute()
	{
		if ($this->genero=='male')
		{
			return 'Masculino';
		}
		else
		{
			return 'Femenino';
		}
	}

	public function getGeneroEresTitleAttribute()
	{
		if ($this->genero=='male')
		{
			return 'Hombre';
		}
		else
		{
			return 'Mujer';
		}
	}

	public function setPasswordAttribute($value)
	{
		if (! empty ($value))
		{
			$this->attributes['password'] = \Hash::make($value);
		}
	}

	public function getRolTitleAttribute()
	{
		if ($this->rol_id==1)
		{
			return 'usuario';
		}
		else if  ($this->rol_id==2)
		{
			return 'administrador';
		}
		else if  ($this->rol_id==3)
		{
			return 'Miradita Loja';
		}
	}

	public function getRolVistosoTitleAttribute()
	{
		if ($this->rol_id == 1)
		{
			return 'Usuario';
		}
		else if	($this->rol_id == 2)
		{
			return 'Administrador';
		}
		else if ($this->rol_id == 3)
		{
			return 'Super';
		}
	}


	/* *Encripta valor de teléfono  */
	public function setTelefonoAttribute($value)
	{
		if (! empty ($value))
		{
			$this->attributes['telefono'] = \Crypt::encrypt($value);
		}else if(empty($value)){
			$this->attributes['telefono'] = "";	
		}
	}

	/* *Encripta valor de teléfono  */
	public function getTelefonoAttribute($value)
	{
		if (! empty ($value))
		{
			return  \Crypt::decrypt($value);
		}
	}
}
