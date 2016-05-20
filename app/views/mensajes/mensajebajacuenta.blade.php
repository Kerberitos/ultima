@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<p class="text-center subtitulo-aviso">Cuenta eliminada</p>
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8" >				
				<p class="text-center alert alert-success">{{ $cuenta->usuario->nombres}} tu cuenta ha sido dada de baja correctamente.
						
				
				</p>
				<div>	
					<p class="texto-justificado">Recuerda que si en algún momento deseas regresar, puedes volver a utilizar tu correo electrónico {{ $cuenta->correo }}.
					</p>
				</div>
			</div>
		</div>
	</div>	
</div>	
	
@stop