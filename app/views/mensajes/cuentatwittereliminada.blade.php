@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<p class="text-center subtitulo-aviso">Cuenta eliminada!</p>
		<div class="row">
							
			<div class="col-xs-12 col-sm-offset-2 col-sm-8" >
				<p class="centrar alert alert-info">Ya contabas con una cuenta en Miradita Loja, pero la eliminaste.
				</p>

				<p class="texto-justificado">El correo electrónico asociado a tu cuenta de twitter con que intentas ingresar ya estaba con anterioridad asociada a una cuenta de usuario en Miradita Loja, pero la eliminaste, si deseas activar nuevamente tu cuenta, clic en el botón reactivar cuenta.
				</p>

				<div>
					
						<a class="btn btn-info col-xs-12 col-sm-offset-3 col-sm-6 " href="{{ URL::route('reactivacioncuenta')  }}">Reactivar mi cuenta</a>
					
				</div>
				
			</div>
		</div>
	</div>	
</div>	
	
@stop