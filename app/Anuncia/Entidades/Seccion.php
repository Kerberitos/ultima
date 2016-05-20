<?php namespace Anuncia\Entidades;

class Seccion extends \Eloquent
{
	protected $table = 'secciones';
	
	public function anuncios()
    {
        return $this->hasMany('Anuncia\Entidades\Anuncio');
    }

    public function categorias()
    {
        return $this->hasMany('Categoria');
    }
    
}