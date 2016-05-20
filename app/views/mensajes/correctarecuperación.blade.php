@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<p class="text-center subtitulo-aviso">Su cuenta está lista para ser usada</p>
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8" >				
				<p class="alert alert-success text-center">{{ $cuenta->usuario->nombres}} ahora puede ingresar con su correo y la nueva contraseña establecida.
				</p>
			
					<p class="texto-justificado">Si tiene alguna sugerencia no dude en comunicarse con nosotros, saludos.
					</p>
			</div>
		</div>
	</div>	
</div>	
	
@stop