@extends('layout')
@section('contenido')

<div class="contenedor-interno">		
	<div class="container-fluid">
		<p class="text-center subtitulo-aviso">Token de restablecimiento inválido!</p>
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8" >


				<div  class="alert alert-danger col-xs-12 text-center">
					<p>El enlace de restablecimiento en el que has hecho clic ha expirado. Por favor, solicita uno nuevo</p>
				</div>	
	
			</div>
		</div>
	</div>	
</div>		

@stop
