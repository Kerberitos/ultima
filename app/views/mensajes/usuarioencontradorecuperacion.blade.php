@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="contenedor-aviso">
		<h2 class="text-center">Revise su correo electrónico para recuperar su contraseña</h2>
		
			<div class="col-xs-12 col-sm-offset-2 col-sm-8" >				
				<p class="alert alert-info text-center">{{ $usuario->nombres}} hemos encontrado una cuenta en miradita asociada a ese correo electrónico, le enviamos un mensaje a <span class="lbl-correo-aviso"> {{$usuario->cuenta->correo}}</span>, por favor revise su bandeja de entrada y siga los pasos para recuperar su contraseña.
				</p>
				
			</div>
	</div>		
		
</div>	
	
@stop