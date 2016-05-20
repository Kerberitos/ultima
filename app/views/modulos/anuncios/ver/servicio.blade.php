@extends('layout')
@section('metas')
	<meta property='og:locale' content='es_ES'/>
	<meta property="og:type" content="articulo"/>
	<meta property="og:title" content="Anuncio sobre servicios de {{$anuncio->anunciante->anunciante}}"/>
	<meta property="og:description" content="{{$anuncio->titulo}}"/>
	<meta property='og:site_name' content='Miradita Loja'/>
	<meta property="og:image" content="{{ asset($anuncio->foto1) }}"/>
	
@stop
@section('contenido')
	
<div class="contenedor-interno">

	<div class="text-center">
		<h3>Anuncio servicio</h3>
	</div>

	@if($anuncio->estado_id==3)
		<div class="col-xs-12">
			@include('modulos.anuncios.ver.detalles.mensajessuperioresestado')	
		</div>
		
	@endif

	@if(Session::has('error_bloqueado'))
		<p class="alert alert-danger">{{Session::get('error_bloqueado')}}</p>

	@endif
	
	@if(Session::has('status_ok'))
		<p class="alert alert-success">{{Session::get('status_ok')}}</p>

	@endif
	
	@if(Session::has('status_error'))
		<p class="alert alert-success">{{Session::get('status_error')}}</p>
	@endif

	@if(Session::has('agendar_ok'))
		<p class="alert alert-success">{{Session::get('agendar_ok')}}</p>

	@endif
	
	@if(Session::has('agendar_error'))
		<p class="alert alert-danger">{{Session::get('agendar_error')}}</p>
	@endif
	
	@if($anuncio->estado_id==6)
		@if(is_admin())
			<p class="alert alert-danger"> Este anuncio se encuentra denunciado, por favor revisa en tu panel de administrador los anuncios denunciados para conocer los motivos de denuncia.</p>
		
		@endif
	@endif
	
	@if(Auth::check())
			@if(Auth::id()==$anuncio->usuario_id & $anuncio->estado_id==6)
				<div class="col-xs-12">
					<p class="alert alert-warning"> Tu anuncio fue denunciado, un administrador los revisará y si no incumple ninguna norma de uso, tu anuncio será activado inmediatamente, esperamos tu comprensión.</p>
				</div>

			@endif
	@endif
	


	<div class="row">
	{{-- Form::open(['route'=>'clasificadocreado', 'method'=>'POST', 'role'=>'form','files' => true, 'novalidate']) --}}		<div class="col-xs-12"> 
		
			@if(Session::has('comentario_estatus_ok'))
		    	<p class="alert alert-success">{{Session::get('comentario_estatus_ok')}}</p>
		    @endif
		     @if(Session::has('comentario_estatus_error'))
		    	<p class="alert alert-danger">{{Session::get('comentario_estatus_error')}}</p>
		    @endif
		    @if (Session::has('error_de_registro_servidor'))
	       	<p class="alert alert-danger alert-size">Hubo un error con el servidor, inténtalo nuevamente, si el problema persiste, comunícate con nosotros.</p>
	    @endif
   		</div>

		<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 cabeza">
			<ol class="breadcrumb">
			  <li><a href="#">Inicio</a></li>
			  <li><a href="{{ route('verservicios') }}">{{$anuncio->seccion_title}}</a></li>
			  <li><a href="{{ route('servicios.categoria.n',[$anuncio->categoria->id]) }}">{{$anuncio->categoria->categoria}}</a></li>
			  <li><a href="{{ route('servicios.subcategoria.n',[ $anuncio->categoria->id, $anuncio->subcategoria->id ]) }}">{{$anuncio->subcategoria->subcategoria}}</a></li>
			  <li class="active">{{$anuncio->id}}</li>
			</ol>

		
		</div><!--fin cabeza-->				
		
		@if(Auth::check())
			@if(Auth::id()==$anuncio->usuario_id & $anuncio->estado_id==1)
			<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
				<p class="alert alert-info">Este anuncio fue creado por ti.</p>
			</div>
			@endif
		@endif

		<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 titulo-anuncio">
			{{  mb_strtoupper($anuncio->titulo)}}
		</div>
		
		<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 accion-anunciante">

			
				<p>El anunciante <span class="label label-success">{{$anuncio->pregunta_title}}</span></p>
			

		</div>

		<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 ">

				<!--Aqui debe ir segmento informacion del anuncio-->
			<div class="row">
				<!--div class="col-xs-12 col-sm-12 col-md-6 subcuerpo-izquierda"-->
				<div class="col-xs-12 col-sm-6 col-md-6 ">
					<!--carrusel de fotos-->
					@include('modulos.anuncios.ver.detalles.detallefotos')
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 detalleanuncio">

					<!--detalle..descripcion del anuncio-->
					@include('modulos.anuncios.ver.detalles.detalleanuncio')
					
				</div>


				<div class="col-xs-12 col-sm-6 col-md-6">
					
						@if( $anuncio->direccion)
							<p><span><strong>Dirección: </strong></span>{{$anuncio->direccion}}</p>
						
						@else
							<p><span><strong>Dirección: </strong></span>No se ha especificado dirección por parte del anunciante.</p>

						@endif
					
				</div>

			</div>
		</div>
		
		<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 ">
			<div class="col-xs-12 col-sm-6 col-md-6 ">	
				@include('modulos.anuncios.ver.detalles.detalleanunciante')
			</div>
			@if($anuncio->estado_id == 1)
			<div class="col-xs-12 col-sm-6 col-md-6 ">
				
					<label for="">Compartir anuncio en redes sociales</label>	
				<div class="centrar-botones-compartir">	
					
					<a title="Compartir en facebook" href="https://www.facebook.com/sharer/sharer.php?u=http://miraditaloja.com/ver/anuncio/Servicios/{{$anuncio->id}}" target="_blank" class="enlace-share">
						<span class="icon-facebook btncompartir-social btncompartir-facebook"></span>

					</a>
					
					<a title="Compartir en twitter" href="http://www.twitter.com/home?status=Mira mi anuncio en http://miraditaloja.com/ver/anuncio/Servicios/{{$anuncio->id}}" target="_blank" class="enlace-share">
						<span class="icon-twitter btncompartir-social btncompartir-twitter"></span>
					</a>

					<a title="Compartir en google" href="https://plus.google.com/share?url=http://miraditaloja.com/ver/anuncio/Servicios/{{$anuncio->id}}" target="_blank" class="enlace-share">

						<span class="icon-googleplus btncompartir-social btncompartir-google"></span>

					</a>
				</div>
			</div>
			@endif
		</div>
		
		<!--Los comentarios van aqui-->
@include('modulos.anuncios.ver.detalles.detalletodosloscomentarios')

<!--Inicio comentar-->
@if(Auth::check())
	@if(Auth::id()!=$anuncio->usuario_id)
		@include('modulos.anuncios.ver.detalles.detallecomentar')
	@endif	
@endif
<!--Fin comentar-->


		@if(Auth::check())	
			@if(is_admin())
				@include('modulos.anuncios.ver.detalles.botonbloquear')
			@endif
		@endif

	</div><!--fin row-->
	{{-- Form::close() --}}

</div><!--fin contenedor-interno-->


@include('modales.mensajedesdeanuncio')
@include('modales.modalagendaranunciante')
@include('modales.modalbloquearanuncio')
@include('modales.modaldenuncia')
 

@stop

