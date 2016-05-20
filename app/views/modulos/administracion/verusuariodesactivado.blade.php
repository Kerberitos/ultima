@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Detalles de la cuenta de usuario desactivada</h4>
    </div>



<div class="row">
 
    <div class="col-xs-12  col-sm-offset-1 col-sm-6 panel-informacion-admin espacio-superior-peq">
        <label class="texto-azul espacio-superior-peq">Información general</label>

        <div class="row linea-separadora espacio-superior-peq">
              <div class="col-xs-12 col-sm-4">
                  {{ Form::label('id_usuario','Id del usuario:') }}
              </div>
         
              <div class="col-xs-12 col-sm-8">
                    <p>  
                        {{ $usuario->id }}
                    </p>
              </div> 
        </div>
        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-4">
                  {{ Form::label('correo','Correo:') }}
              </div>
         
              <div class="col-xs-12 col-sm-8">
                    <p class="lbl-detalle-correo">  
                        {{ $usuario->cuenta->correo }}
                    </p>
              </div> 
        </div>
       <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-4">
                  {{ Form::label('nombres','Nombres:') }}
              </div>
         
              <div class="col-xs-12 col-sm-8">
                    <p >  
                        {{ $usuario->nombres }}
                    </p>
              </div> 
        </div>
        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-4">
                  {{ Form::label('genero','Género:') }}
              </div>
         
              <div class="col-xs-12 col-sm-8">
                    <p >  
                        {{ $usuario->genero_title }}
                    </p>
              </div> 
        </div>

        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-4">
                  {{ Form::label('rol','Rol:') }}
              </div>
         
              <div class="col-xs-12 col-sm-8">
                    <p>  
                        
                            {{ $usuario->rol_title }}
                        
                        
                        
                    </p>
              </div> 
        </div>

        
        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-4">
                  {{ Form::label('registrado','Se registró:') }}
              </div>
         
              <div class="col-xs-12 col-sm-8">
                    <p >  
                        El {{$usuario->created_at->format('l, j').' de '.$usuario->created_at->format('M').' del '.$usuario->created_at->format('Y') }}
                    </p>
              </div> 
        </div>
        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-4">
                  {{ Form::label('estado','Estado:') }}
              </div>
         
              <div class="col-xs-12 col-sm-8">
                    <p >  
                        {{ $usuario->cuenta->estado->estado }}
                    </p>
              </div> 
        </div>
        <div class="row">
              <div class="col-xs-12 col-sm-4">
                  {{ Form::label('sociallogin','Social login:') }}
              </div>
         
              <div class="col-xs-12 col-sm-8">
                    <p>
                        @if($usuario->bandera_social==true)
                            Si, ingresó con red social
                        @else
                            No, ingresó por correo
                        @endif  
                        
                    </p>
              </div> 
        </div>
    </div><!--fin panel informacion admin izquierda-->
    
    <div class="col-xs-12 col-sm-offset-1 col-sm-3 espacio-superior-peq text-center">
        <label class="espacio-superior-peq">Acciones de administrador</label>
        
         <div class="col-xs-12">
          <div class="row">

            @if($usuario->cuenta->estado->estado=="desactivado")
                <a href="" data-toggle="modal" data-target="#modalcorreoautomatizado"  class="btn col-xs-12 btn-warning btn-sm  espacio-superior-min" title="Enviar correo automatizado">
                              
                           Enviar correo automatizado
                </a>
            @endif
            

              <a href="{{route('admin.usuarios.desactivados')}}"  class="btn btn-primary col-xs-12 espacio-superior-peq" title="Ir a usuarios desactivados"><span class="glyphicon glyphicon-menu-left"></span> Usuarios desactivados</a>


          </div>



          



        
        </div>
    </div><!--fin acciones de admin-->

   
</div><!--fin row inicial-->
</div><!--fin contenedor interno-->
@include('modales.modalcorreoautomatizado')
@stop