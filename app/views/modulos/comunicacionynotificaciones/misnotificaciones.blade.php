@extends('layout')
@section('contenido')
	@parent
	<div class="contenedor-interno">
		<div class="text-center">	
			<h3>Notificaciones</h3>
		</div>	
		@if(Session::has('estatus_ok'))
			<p class="alert alert-success">{{Session::get('estatus_ok')}}</p>
		@endif
		@if(Session::has('estatus_error'))
			<p class="alert alert-danger">{{Session::get('estatus_error')}}</p>
		@endif

		@if (sizeof($usuario->notificaciones)==0)
    		<p class="alert alert-info"> No tiene ninguna notificación por el momento</p>
  		@endif


		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-8">

				@foreach ($usuario->notificaciones as $notificacion)
					<a href="{{ route('vernotificacion',[$notificacion->id ]) }}" title="">
						<div class="col-xs-12 col-sm-12 notificacion notificacion-{{$notificacion->estatus_visto}} notificacion-info-{{$notificacion->estatus_visto}}">
							<div>
								<p>{{$notificacion->created_at->format('l, j M Y H:i a')}}</p>
							</div>
							
							<p class="col-sm-offset-1">	
							@if($notificacion->tipo=="comentario")
								@if($notificacion->notificacion=="comentario")
									<span class="icon-chat"></span> Nuevo comentario en tu anuncio con identificativo {{$notificacion->identificativo}} 

								@elseif($notificacion->notificacion=="respuesta")
									<span class="icon-chat"></span> Hay respuesta a un comentario que realizaste en el anuncio con identificativo {{$notificacion->identificativo}}

								@elseif($notificacion->notificacion=="acciones")
									<span class="icon-chat"></span> Han realizado algunos comentarios o respuestas en tu anuncio con identificativo {{$notificacion->identificativo}}
								@endif
			
							@elseif($notificacion->tipo=="anuncio")
								@if($notificacion->notificacion=="publicado")
									<span class="glyphicon glyphicon glyphicon-ok"></span> Tu anuncio con identificativo {{$notificacion->identificativo}}  fue publicado correctamente, todos pueden verlo.
								@elseif($notificacion->notificacion=="rechazado")
									<span class="glyphicon glyphicon-exclamation-sign"></span> Tu anuncio con identificativo {{$notificacion->identificativo}}  no pasó la revisión, no fue publicado.
								@elseif($notificacion->notificacion=="bloqueado")
									<span class="icon-forbid"></span> Tu anuncio con identificativo {{$notificacion->identificativo}}  fue bloqueado por infringuir una norma de uso.
								@endif

							@elseif($notificacion->tipo=="system")

								@if($notificacion->notificacion=="promovido")
									<span class="icon-users-2"></span> Bienvenido al equipo de administradores de Miradita Loja, ya eres administrador
								@elseif($notificacion->notificacion=="nopromovido")
									<span class="icon-users-2"></span> Tu solicitud para Administrador fue rechazada, no te desanimes.
								@endif
							@endif
							</p>


						</div>
					</a>
				@endforeach


			</div>
			
		</div>
	</div>
@stop
