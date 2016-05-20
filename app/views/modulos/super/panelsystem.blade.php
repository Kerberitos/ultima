@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h3>Sistema</h3>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-6 general-anuncios">
           
            <a href="{{route('super.notificaciones')}}" class="btn btn-warning btn-md col-xs-12 col-sm-5" role="button">
                <span class="icon-bell-alt">
                </span>
                <p class="size-font-admin">Notificaciones <span class="mostrar-ocultar"></span>expiradas</p>
                <span class="badge">
                        {{ $numNotificacionesExpiradas }}
                </span>
                
            </a>
            
            <a href="{{route('super.anuncios')}}" class="btn btn-primary btn-md col-xs-12 col-sm-offset-1 col-sm-5" role="button">
                <span class=" icon-danger">
                </span>
                <p class="size-font-admin">Anuncios <span class="mostrar-ocultar"></span>expirados</p>
                <span class="badge">
                        {{ $numAnunciosExpirados }}
                </span>
            </a>
        </div>    
        <div class="col-xs-12 col-sm-6 general-anuncios">
            <a href="{{route('super.anuncios.ocupados')}}" class="btn btn-info btn-md col-xs-12 col-sm-5" role="button">
                <span class="icon-sad">
                </span>
                <p class="size-font-admin">Anuncios <span class="mostrar-ocultar"></span>ocupados</p>
                <span class="badge">
                        {{ $numAnunciosOcupados }}
                </span>
            </a>
            <a href="{{route('super.configuraciones')}}" class="btn btn-primary btn-md col-xs-12 col-sm-offset-1 col-sm-5" role="button">
                <span class="icon-cog-2">
                </span>
                <p class="size-font-admin">Configuraciones <span class="mostrar-ocultar"></span>del sistema</p>
                 <span class="badge">
                        <span class="icon-cog">
                        </span>
                </span>
            </a>
            


        </div>   
    </div> 
</div><!--fin contenedor interno-->
@stop