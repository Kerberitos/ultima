@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h3>Revisiones que tienes pendiente</h3>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-6 general-anuncios">
            <p class="subtitulos-caja">ANUNCIOS PENDIENTES</p>
            <a href="{{route('admin.solicitudes.pendientes')}}" class="btn btn-warning btn-md col-xs-12 col-sm-5" role="button">
                <span class="glyphicon glyphicon-eye-open">
                </span>
                <p class="size-font-admin">Anuncios <span class="mostrar-ocultar"></span> que estás <span class="mostrar-ocultar"></span>revisando</p>

                    <span class="badge">
                        {{ $anunciosPendientes }}
                    </span>




            </a>
            
            <a href="{{route('admin.denunciados.pendientes')}}" class="btn btn-danger btn-md col-xs-12 col-sm-offset-1 col-sm-5" role="button">
                <span class="glyphicon glyphicon-exclamation-sign">
                </span>
                <p class="size-font-admin">Anuncios <span class="mostrar-ocultar"></span> denunciados<span class="mostrar-ocultar"></span> pendientes</p>
                    <span class="badge">
                        {{ $anunciosDenunciadosPendientes }}
                    </span>


            </a>
        </div>   

        <div class="col-xs-12 col-sm-6 general-anuncios">
            <p class="subtitulos-caja">COMENTARIOS Y RESPUESTAS PENDIENTES</p>
            <a href="{{route('admin.revisar.comentarios.pendientes')}}" class="btn btn-danger btn-md col-xs-12 col-sm-5" role="button">
                <span class="icon-chat"></span> 
                <p class="size-font-admin">Comentarios <span class="mostrar-ocultar"></span> denunciados  <span class="mostrar-ocultar"></span>pendientes</p>
                    <span class="badge">
                        {{ $comentariosDenunciadosPendientes}}
                    </span> 
            </a>

            <a href="{{route('admin.revisar.respuestas.pendientes')}}" class="btn btn-danger btn-md col-xs-12 col-sm-offset-1 col-sm-5" role="button">
                <span class="icon-pencil-2"></span> 
                <p class="size-font-admin">Respuestas <span class="mostrar-ocultar"></span>denunciadas <span class="mostrar-ocultar"></span>pendientes</p>
                    <span class="badge">
                        {{$respuestasDenunciadasPendientes}}
                    </span> 
            </a>

        </div>
    </div> 








</div><!--fin contenedor interno-->
@stop