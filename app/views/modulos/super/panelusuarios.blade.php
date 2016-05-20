@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h3>Usuarios del sistema</h3>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-6 general-anuncios">
           
            <a href="{{route('lista.usuarios.postulantes')}}" class="btn btn-warning btn-md col-xs-12 col-sm-5" role="button">
                <span class="icon-board">
                </span>
                <p class="size-font-admin">Solicitudes <span class="mostrar-ocultar"></span>para administrador</p>
                <span class="badge">
                        {{ $numPostulantes }}
                </span>
            </a>
            
            <a href="{{route('lista.usuarios.bloqueados')}}" class="btn btn-primary btn-md col-xs-12 col-sm-offset-1 col-sm-5" role="button">
                <span class="icon-evil-2">
                </span>
                <p class="size-font-admin">Usuarios <span class="mostrar-ocultar"></span>bloqueados</p>
                <span class="badge">
                        {{ $numUsuariosBloqueados }}
                </span>
            </a>
        </div>    
            
        <div class="col-xs-12 col-sm-6 general-anuncios">
            <a href="{{route('lista.usuarios.desactivados')}}" class="btn btn-info btn-md col-xs-12 col-sm-5" role="button">
                <span class="icon-sad">
                </span>
                <p class="size-font-admin">Usuarios <span class="mostrar-ocultar"></span>desactivados</p>
                <span class="badge">
                        {{ $numUsuariosDesactivados }}
                </span>
            </a>
             <a href="{{ route('lista.usuarios.activos')}}" class="btn btn-success btn-md col-xs-12 col-sm-offset-1 col-sm-5" role="button">
                <span class="icon-happy">
                </span>
                <p class="size-font-admin">Usuarios <span class="mostrar-ocultar"></span>activos</p>
                <span class="badge">
                        {{ $numUsuariosActivos }}
                </span>
            </a>


        </div>   
    </div> 
</div><!--fin contenedor interno-->
@stop