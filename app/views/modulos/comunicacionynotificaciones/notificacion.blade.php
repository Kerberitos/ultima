@extends('layout')
@section('contenido')
	
	<div class="contenedor-interno">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 espacio-superior-peq">
				<div class="row linea-inferior">
    			      <div class="col-xs-12 col-sm-10 fechanotificacion">
					        <p>{{$notificacion->created_at->format('l, j M Y H:i a')}}</p>
				      </div> 
			    </div>
			    <div class="row">
				      <div class="col-xs-12 col-sm-3">
				          {{ Form::label('notificacion','NOTIFICACIÓN:') }}
				      </div>
			    </div>
			    <div class="row linea-inferior">
			 
				      <div class="col-xs-12 col-sm-10">
					       @if($notificacion->notificacion=="publicado")
					       	   <p class="texto-justificado">Tu anuncio {{$anuncio->titulo}} paso la revisión y fue <strong> publicado correctamente </strong>, ahora todos los usuarios pueden verlo.</p>
					       
					       
					       @elseif($notificacion->notificacion=="rechazado")
					       		 <p class="texto-justificado">Tu anuncio {{$anuncio->titulo}} no paso la revisión por ello <strong>no fue publicado</strong>, por favor editalo de tal forma que no incumpla ninguna norma de uso. Y luego puedes pedir nuevamente su publicación</p>
					       	
					       	@elseif($notificacion->notificacion=="bloqueado")
					       		<p class="texto-justificado">Tu anuncio {{$anuncio->titulo}}  <strong> fue bloqueado</strong> por un administrador debido a que infringue alguna norma de uso de miradita. Recuerda que con {{$anunciosBloqueadosPermitidos}} anuncios bloqueados automáticamente tu cuenta de usuario será bloqueada. </p>
					       		<p class="texto-justificado">Por favor hagámos de miradita un sitio ordenado y limpio de anuncios indeseados. Gracias!</p>
					       	
					       	@elseif($notificacion->notificacion=="promovido")
					       		<p class="texto-justificado">Bienvenido {{\Auth::user()->nombres}} , es una alegría para nosotros que te hayas unido a nuestro equipo de administradores.</p>
					       		
					       		@if(\Auth::user()->rol_id == 2 | \Auth::user()->rol_id == 3)
					       			<p class="texto-justificado">Puedes
					       			<a href="{{ route('activar.menu.administrador') }}" class="enlace">activar el panel de administrador 
					       			</a> e irte familiarizando con el mismo.
					       		@endif
					       	@elseif($notificacion->notificacion=="nopromovido")
					       		<p class="texto-justificado">{{\Auth::user()->nombres}}, lamentamos informarte que tu solicitud de postulación a administrador fue rechazada, nosotros te consideraremos en una futura conovocatoria. No te desanimes, más adelante puede que llegues a formar parte de nuestro equipo. </p>
					       						       	
					       	
					       	@elseif($notificacion->notificacion=="comentario")
					       		<p class="texto-justificado">Hay nuevo comentario en tu anuncio {{$anuncio->titulo}} </p>
					       	
					       	@elseif($notificacion->notificacion=="respuesta")
					       		<p class="texto-justificado">Alguien a respondido a un comentario que has realizado en el anuncio {{$anuncio->titulo}} </p>
					       	@elseif($notificacion->notificacion=="acciones")
					       		<p class="texto-justificado">Hay acciones de comentario o respuestas nuevas en tu anuncio {{$anuncio->titulo}} </p>	
					       @endif
				      </div> 
			    </div>
			   
			   
			</div>

			
			@if(!empty($notificacion->identificativo))
				<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
					<p>La notificación hace referencia a  
						<a href="{{ route('veranuncio',[ $anuncio->seccion_title, $notificacion->identificativo ]) }}" target="_blank" class="enlace">este anuncio</a>
					</p>
				</div>
			@endif
			
			
			<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 espacio-superior-peq">
				<a href="{{route('misnotificaciones')}}" title="" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true" ></span> Regresar a notificaciones</a>	
			</div>

		</div>
	</div>
@stop
