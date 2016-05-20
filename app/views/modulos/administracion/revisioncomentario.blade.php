@extends('layout')
@section('contenido')
	
	<div class="contenedor-interno">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 espacio-superior-peq">
			    
				     
				          {{ Form::label('comentario','COMENTARIO DENUNCIADO:') }}
				     
			   
			</div>

			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 cuadro-comentario">
				<p>{{$comentario->comentario}}</p>
				
			</div>

			
			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8">
				<p>El comentario se encuentra en 
					<a href="{{ route('veranuncio',[ $comentario->anuncio->seccion_title, $comentario->anuncio->id ]) }}" target="_blank" class="enlace"> este anuncio</a>
				</p>
			</div>
			
			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8">
				<div class="row">
					@include('modulos.administracion.segmentos.botonescomentariodenunciadobloqueonormalidad')
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-offset-2 col-sm-6 col-md-offset-2 col-md-6 espacio-superior-peq">
				<a href="{{route('admin.revisar.comentarios.denunciados')}}" title="" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true" ></span> Regresar atrás</a>	
			</div>

			@include('modales.modalcomentariodenunciaaprobada')
			@include('modales.modalcomentariodenunciarechazada')
		</div>
	</div>
@stop
