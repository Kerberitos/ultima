@extends('layout')
@section('contenido')

<div class="contenedor-interno">		
	<div class="container-fluid">
		<p class="text-center subtitulo-aviso">Token de recuperación inválido!</p>
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8" >


				<div  class="alert alert-danger col-xs-12 text-center">
					<p>El token del enlace de recuperación de contraseña ha expirado. Por favor, solicita uno nuevo</p>				
				</div>	
	
			</div>
		</div>
	</div>	
</div>		

@stop




