@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h3>Publicar en nuestras redes sociales</h3>
    </div>
    <div class="row">
       <div class="col-xs-12 col-sm-offset-3 col-sm-6"> 
                    <p class="parrafo-mensaje"> El anuncio de id: {{ $anuncio->id}} fue activado correctamente por ti, pero aún no se encuentra publicado en las redes sociales de Miradita Loja</p>

                    <p class="parrafo-mensaje"> Recuerda que para poder publicar en nuestra fan page debes ser administrador de la página de facebook, y debes iniciar sesión previamente en tu cuenta de facebook y compartir como página.</a>
                    </p>
                    
                @if($anuncio->seccion_id==1)
                    <a title="Compartir en facebook" href="https://www.facebook.com/sharer/sharer.php?u=http://miraditaloja.com/ver/anuncio/Clasificados/{{$anuncio->id}}" target="_blank" class="btn btn-success col-xs-12 col-sm-offset-3 col-sm-6">

                        <span>Publicar en redes sociales</span>
                    </a>
                @elseif($anuncio->seccion_id==2)
                     <a title="Compartir en facebook" href="https://www.facebook.com/sharer/sharer.php?u=http://miraditaloja.com/ver/anuncio/Servicios/{{$anuncio->id}}" target="_blank" class="btn btn-success col-xs-12 col-sm-offset-3 col-sm-6"
                        <span>Publicar en redes sociales</span>
                    </a>

                @elseif($anuncio->seccion_id==3)
                     <a title="Compartir en facebook" href="https://www.facebook.com/sharer/sharer.php?u=http://miraditaloja.com/ver/anuncio/Empleos/{{$anuncio->id}}" target="_blank" class="btn btn-success col-xs-12 col-sm-offset-3 col-sm-6">

                        <span>Publicar en redes sociales</span>
                    </a>


                @endif

                <a href="{{ route('admin.publicar') }}" class="btn btn-primary btn-salir col-xs-12 col-sm-offset-3 col-sm-6">
                    Revisar más anuncios
                </a>

        </div>          
                
                
                    
                 



    </div>

</div><!--fin contenedor interno-->
@stop