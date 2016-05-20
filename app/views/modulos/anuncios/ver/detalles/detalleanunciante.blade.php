<fieldset>
 	<p><label>DATOS DEL ANUNCIANTE</label></p>
 		<p><label>Preguntar por: </label> {{ $anuncio->anunciante->anunciante }}</p>
		<p><label>Tipo: </label> {{ $anuncio->anunciante->tipopersona_title }}</p>
		<p><label>Celular: </label> {{ $anuncio->anunciante->celular }} - {{ $anuncio->anunciante->compania_id_title }} </p>
		<p><label>Utiliza Whatsapp: </label> {{ $anuncio->anunciante->whatsapp_title }}</p>
		@if( $anuncio->anunciante->telefono)
			<p><label>Teléfono: </label> {{ $anuncio->anunciante->telefono }}</p>

		@endif
		

		<div>
			
			@if(Session::has('status_ok'))
				<p class="bg-success text-success">{{Session::get('status_ok')}}</p>

			@endif

			@if(Session::has('status_error'))
				<p class="bg-danger text-danger">{{Session::get('status_error')}}</p>

			@endif

			@if(Session::has('status_error'))
				

				<p class="alert alert-danger text-danger">
					{{ $errors->first('nombre', ':message')}}
					{{ $errors->first('apellido', ':message')}}
					{{ $errors->first('correo', ':message')}}
					{{ $errors->first('asunto', ':message')}}
					{{ $errors->first('mensaje', ':message')}}
				</p>
			@endif
		</div>


		@if(Auth::check())
			@if(Auth::id()!=$anuncio->usuario_id)
				
				<a href="" data-toggle="modal" data-target="#mensajedesdeanuncio" class="btn btn-warning btn-xs btn-separado" title="">Escribir un mensaje</a>

			@endif
		@endif

		{{--Solo se muestra boton agendar anunciante si se tiene cuenta en miraditaloja--}}
		@if(Auth::check())
			@if(Auth::id()!=$anuncio->usuario_id)
				<a href="" data-toggle="modal" data-target="#modalagendaranunciante" class="btn btn-info btn-xs btn-separado" title="">Agendar anunciante</a>
			@endif
		@endif
		@if(Session::has('agendar_ok'))
			<p class="bg-success text-success">{{Session::get('agendar_ok')}}</p>

		@endif
		@if(Session::has('agendar_error'))
			<p class="bg-danger text-danger">{{Session::get('agendar_error')}}</p>

		@endif
		@if(Session::has('agendar_error'))
				<p class="alert alert-danger text-danger">
					
					{{ $errors->first('nota', ':message')}}
					
				</p>
			@endif
</fieldset>

