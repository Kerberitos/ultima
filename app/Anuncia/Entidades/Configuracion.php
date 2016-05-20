<?php namespace Anuncia\Entidades;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class Configuracion extends \Eloquent
{
	protected $table = 'configuraciones';

	protected $fillable=array(
		'anunciosadministrador',
		'anunciosbloqueados',
		'anunciosusuario',
		'comentariosbloqueados',
		'contadordedenuncias',
		'solicitudes',
	);
}