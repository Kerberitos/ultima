
<label>DETALLES DEL ANUNCIO</label>

	<div>
		<p>{{ nl2br($anuncio->descripcion) }}</p>
	</div>
	{{--solo si el usuario ha iniciado sesión correctamente se visualiza el botón de denunciar anuncio 
		y además no se visualizará si el anuncio fue creado pro el usuario autenticado   --}}
	@if(Auth::check())
		@if(Auth::id()!=$anuncio->usuario_id & (!is_admin(Auth::id())) & Auth::user()->estado_id==1)
			<div>
				<a href="" data-toggle="modal" data-target="#denuncia" class="btn btn-danger btn-xs btn-separado" title="">Denunciar anuncio</a>
			</div>
		@endif
	@endif
	
	@if(Session::has('denuncia_error'))
			<p class="alert alert-danger">{{Session::get('denuncia_error')}}</p>

	@endif