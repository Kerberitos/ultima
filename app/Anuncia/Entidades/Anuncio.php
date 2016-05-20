<?php namespace Anuncia\Entidades;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class Anuncio extends \Eloquent
{
	protected $table = 'anuncios';
	
	protected $fillable = array(
		'categoria_id',
		'direccion',
		'estado',
		'valor',
		'opcionvalor',
		'pregunta',
		'seccion_id',
		'subcategoria_id',
		'tipo',
	);

	/* *relación con usuario (retorno) */
	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}
	
	

	public function categoria()
	{
		return $this->belongsTo('Anuncia\Entidades\Categoria');
	}
	public function subcategoria()
	{
		return $this->belongsTo('Anuncia\Entidades\Subcategoria');
	}

	public function anunciante(){
		return $this->hasOne('Anuncia\Entidades\Anunciante');
	}

	public function seccion(){
		return $this->belongsTo('Anuncia\Entidades\Seccion');
	}
	
	public function comentarios()
    {
        return $this->hasMany('Anuncia\Entidades\Comentario');
    }
	
	


	
	public function getPublicaciondateAttribute($value)
	{
		//$valo=new Date($value);
	    return new Date($value);
	    //dd('ver'.$valo);
	}
	public function getExpiradateAttribute($value)
	{
	    return new Date($value);
	}



	public function getEstadoTitleAttribute(){
		if ($this->estado_id==1){
			return 'Publicado';
		}else if ($this->estado_id==2) {
			return 'Creado';
		}else if ($this->estado_id==3) {
			return 'Bloqueado';
		}else if ($this->estado_id==5) {
			return 'Revision';
		}else if ($this->estado_id==6) {
			return 'Denunciado';
		}else if ($this->estado_id==7) {
			return 'Rechazado';
		}						

	}
	
	public function getSeccionTitleAttribute(){
		if ($this->seccion_id==1){
			return 'Clasificados';
		}else if ($this->seccion_id==2) {
			return 'Servicios';
		}else if ($this->seccion_id==3) {
			return 'Empleos';
		}
	}
	
	public function getSeccionInformativoTitleAttribute(){
		if ($this->seccion_id==1){
			return 'Anuncio Clasificado';
		}else if ($this->seccion_id==2) {
			return 'Anuncio de Servicio';
		}else if ($this->seccion_id==3) {
			return 'Anuncio de Empleo';
		}
	}

	public function getOpcionvalorTitleAttribute(){
		if ($this->opcionvalor=="fijo"){
			return 'No negociable';
		}else if ($this->opcionvalor=="negociable") {
			return 'Negociable';
		}


	}
	public function getTipoTitleAttribute(){
		if ($this->tipo=="tiempocompleto"){
			return 'Tiempo completo';
		}else if ($this->tipo=="mediotiempo") {
			return 'Medio tiempo';
		}else if ($this->tipo=="temporal") {
			return 'Temporal';
		}else if ($this->tipo=="porhoras") {
			return 'Por horas';
		}				
	}
	public function getPreguntaTitleAttribute(){
		if ($this->pregunta==1){
			return 'Vende';
		}else if ($this->pregunta==2) {
			return 'Alquila';
		}else if ($this->pregunta==3) {
			return 'Desea comprar';
		}else if ($this->pregunta==4) {
			return 'Busca alquiler';
		}else if ($this->pregunta==5) {
			return 'Intercambia';
		}else if ($this->pregunta==6) {
			return 'Ofrece servicio';
		}else if ($this->pregunta==7) {
			return 'Necesita trabajo';
		}else if ($this->pregunta==8) {
			return 'Brinda trabajo';
		}else if ($this->pregunta==9) {
			return 'Pasantias';
		}				
	}


	


}