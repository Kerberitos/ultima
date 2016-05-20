@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<p class="text-center subtitulo-aviso">{{ $mensaje['titulo'] }}</p>
		<div class="row">
							
			<div class="col-xs-12 col-sm-offset-2 col-sm-8" >
				<p class="centrar alert alert-info alert-size">{{ $mensaje['contenido_principal'] }}
					
					@if($mensaje['estado']=='desactivado')
					<span class="ocultar-menor-a260">	{{ $correo['correo'] }}	</span>
					@endif
				
				</p>

				<p class="texto-justificado">{{ $mensaje['contenido_secundario'] }}
						
						@if($mensaje['estado']=='bloqueado')
						<p>Puede comunicarse con nosotros al apartado
							
								<a class="enlace" href="{{ URL::route('contactanos')  }}">Contáctanos</a>
							
							para mayor información. Disculpe los inconvenientes.
						</p>
						@endif
				</p>

				<div>
					@if($mensaje['estado']=='eliminado')
						<a class="btn btn-info col-xs-12 col-sm-offset-3 col-sm-6 " href="{{ URL::route('reactivacioncuenta')  }}">Reactivar mi cuenta</a>
					@endif

					@if($mensaje['estado']=='desactivado')
						<a class="btn btn-info col-xs-12 col-sm-offset-3 col-sm-6 " href="{{ URL::route('nuevoenlaceactivacion')  }}">Solicitar nuevo enlace</a>
					@endif
				</div>
				
			</div>
		</div>
	</div>	
</div>	
	
@stop