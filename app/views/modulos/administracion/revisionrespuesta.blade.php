@extends('layout')
@section('contenido')
	
	<div class="contenedor-interno">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 espacio-superior-peq">
			    
			    
			  
				          {{ Form::label('respuesta',' RESPUESTA DENUNCIADA:') }}
			
			</div>

			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 cuadro-comentario">
				<p>{{$respuesta->respuesta}}</p>
				
			</div>

			
				<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8">
					<p>La respuesta se encuentra en 
						<a href="{{ route('veranuncio',[ $respuesta->comentario->anuncio->seccion_title,  $respuesta->comentario->anuncio->id ]) }}" target="_blank" class="enlace"> este anuncio</a>
					</p>
				</div>
				<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8">
					<div class="row">
						@include('modulos.administracion.segmentos.botonesrespuestadenunciadabloqueonormalidad')
					</div>
				</div>
			<div class="col-xs-12 col-sm-offset-2 col-sm-6 col-md-offset-2 col-md-6 espacio-superior-peq">
				<a href="{{route('admin.revisar.respuestas.denunciadas')}}" title="" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true" ></span> Regresar</a>	
			</div>

			@include('modales.modalrespuestadenunciaaprobada')
			@include('modales.modalrespuestadenunciarechazada')
		</div>
	</div>
@stop
