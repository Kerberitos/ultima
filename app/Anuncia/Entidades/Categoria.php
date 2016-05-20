<?php namespace Anuncia\Entidades;

class Categoria extends \Eloquent
{
	protected $table = 'categorias';

	public function seccion()
	{
		return $this->belongsTo('Anuncia\Entidades\Seccion');
	}
	
	public function subcategorias()
    {
        return $this->hasMany('Anuncia\Entidades\Subcategoria');
    }

    public function anuncio()
    {
        return $this->hasMany('Anuncia\Entidades\Anuncio');
    }
}