@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<p class="text-center subtitulo-aviso">Gracias!</p>
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8" >					
				<p class="texto-centrado alert alert-info">{{ $usuario->nombres}} queremos agradecerte por ayudarnos denunciando anuncios que crees incumplen las normas de uso.
				</p>
				<div>	
					<p class="text-center">Miradita es tu espacio, tu comunidad, sin ayuda de cada uno de sus miembros sería difícil mantenerla ordenada, gracias nuevamente! 
					</p>
				</div>
			</div>
		</div>
	</div>	
</div>	
	
@stop