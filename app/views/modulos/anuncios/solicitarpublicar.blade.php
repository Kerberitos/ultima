@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	
		
	<div class="container">
		<h3 class="text-center">¿Desea que su anuncio sea publicado?</h3>

        	<div class="form-group">
		<div class="row">


				<div class="col-xs-12 col-sm-offset-1 col-sm-9">	
					<p class="parrafo-mensaje">{{ $usuario->nombres}} su anuncio aún no se encuentra publicado.</p>

					<p class="parrafo-mensaje"> Para que su anuncio pueda ser visualizado por los demás usuarios solicite que sea publicado, después de eso su anuncio será revisado por un administrador de Miradita y verificará que cumple con las<a href="{{ route('politicas') }}"  target="_blank" title="Políticas de uso de Miradita Loja" class="enlace"> políticas de uso </a>.
					</p>
					<p class="alert alert-info alert-size">Considere que no es obligatorio publicar ahora, si aún no está completo el anuncio, puede solicitar su publicación más adelante.</p>
					
				</div>			
				
				
					
				<a href="{{ route('enviar.solicitud.publicacion', $idanuncio['anuncio_id']) }}" class="btn btn-publicacion col-xs-12 col-sm-offset-4 col-sm-4" title="">Deseo publicar
				</a>
			

		

				<a href="{{ route('misanuncios') }}" class="btn btn-primary btn-salir col-xs-12 col-sm-offset-4 col-sm-4">
        			Ir a Mis anuncios
      			</a>
				
				
		</div>
	</div>	
</div>	
	
@stop