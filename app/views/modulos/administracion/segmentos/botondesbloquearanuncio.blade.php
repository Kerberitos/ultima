@if($anuncio->estado_id==3)
	<div class="col-xs-12  col-sm-offset-4 col-sm-4 contenedor-botonbloqueo">
		<a data-toggle="modal" data-target="#desbloquearanuncio" class="btn btn-success col-xs-12">
       		<i class="icon-forbid">
       		</i>
       			Desbloquear anuncio
		</a>
	</div>
@endif