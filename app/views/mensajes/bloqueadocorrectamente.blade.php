@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<p class="text-center subtitulo-aviso">Anuncio bloqueado!</p>
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8" >				
				<p class="text-center alert alert-info">{{ $admin['nombres']}} muy buen trabajo, has bloqueado correctamente el anuncio.
				</p>
				<div>	
					<p class="texto-justificado">Sin tu ayuda como administrador, sería imposible mantener miradita en orden.
					</p>
				</div>
			</div>
		</div>
	</div>	
</div>	
	
@stop