@if($anuncio->estado_id==1 | $anuncio->estado_id==6)
	<div class="col-xs-12  col-sm-offset-4 col-sm-4 contenedor-botonbloqueo">
		<a data-toggle="modal" data-target="#bloquearanuncio" class="btn btn-danger col-xs-12">
       		<i class="icon-forbid">
       		</i>
       			Bloquear anuncio
		</a>
	</div>
@endif