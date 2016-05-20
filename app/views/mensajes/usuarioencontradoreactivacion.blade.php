@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<p class="text-center subtitulo-aviso">Revise su correo electrónico para reactivar cuenta</p>
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8" >				
				<p class="alert alert-info texto-justificado">{{ $usuario->nombres}} hemos encontrado una cuenta en miradita asociada a ese correo electrónico, le enviamos un mensaje a <span class="lbl-correo-aviso"> {{$usuario->cuenta->correo}}</span>, por favor revise y siga los pasos para reactivar su cuenta.
				</p>
				
				<p class="texto-justificado">Cualquier sugerencia no dudes en comunicarte con nosotros, saludos.
				</p>
				
			</div>
		</div>
	</div>	
</div>	
	
@stop