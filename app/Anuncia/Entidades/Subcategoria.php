<?php namespace Anuncia\Entidades;

class Subcategoria extends \Eloquent
{
	protected $table = 'subcategorias';

	public function anuncio()
    {
        return $this->hasMany('Anuncia\Entidades\Anuncio');
    }
    
	public function categoria()
	{
		return $this->belongsTo('Anuncia\Entidades\Categoria');
	}
	
}