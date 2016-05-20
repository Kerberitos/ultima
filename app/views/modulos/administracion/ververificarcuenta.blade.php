@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Verificación de la cuenta</h4>
    </div>



<div class="row">
    
    @if($cuenta->estado->estado=="activado")
        <p class="alert alert-success alert-size col-xs-12 col-sm-offset-1 col-sm-10"> La cuenta de usuario asociada al correo {{$cuenta->correo}} se encuentra activa </p>

    @elseif($cuenta->estado->estado=="desactivado")
      <p class="alert alert-warning alert-size col-xs-12 col-sm-offset-1 col-sm-10"> La cuenta de usuario asociada al correo {{$cuenta->correo}} se encuentra desactivada </p>
    
    @elseif($cuenta->estado->estado=="bloqueado")
      <p class="alert label-bloqueado alert-size col-xs-12 col-sm-offset-1 col-sm-10"> La cuenta de usuario asociada al correo {{$cuenta->correo}} se encuentra bloqueada </p>

      <p class="alert alert-info alert-size col-xs-12 col-sm-offset-1 col-sm-10">
          La cuenta de {{$usuario->nombres}} fue bloqueada porque 

             @if($usuario->historial)
               
                @if($usuario->historial->anunciosbloqueados >= $configuracionActual->anunciosbloqueados )
                    modificó {{$usuario->historial->anunciosbloqueados}} de sus anuncios ya publicados con contenido que infringe las normas de uso.
                
                @elseif(($usuario->historial->denunciasfalsas - $usuario->historial->denunciasverdaderas)>= $configuracionActual->contadordedenuncias )
                    abusó del sistema de denuncias.  
                @elseif($usuario->historial->comentarioseliminados >= $configuracionActual->comentariosbloqueados)
                    realizó {{$usuario->historial->comentarioseliminados}} comentarios con contenido que incumple alguna norma de uso.

                @endif

            @endif
      </p>


     @elseif($cuenta->estado->estado=="eliminado")
      <p class="alert alert-danger alert-size col-xs-12 col-sm-offset-1 col-sm-10"> La cuenta de usuario asociada al correo {{$cuenta->correo}} , fue eliminada por el usuario el {{ $cuenta->updated_at}} </p>

    
    @endif

   



    <div class="col-xs-12  col-sm-offset-1 col-sm-5 panel-informacion-admin espacio-superior-peq">
        <label class="texto-azul espacio-superior-peq">Información general</label>

        <div class="row linea-separadora espacio-superior-peq">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('correo','Correo:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p class="lbl-detalle-correo">  
                        {{ $cuenta->correo }}
                    </p>
              </div> 
        </div>
       <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('nombres','Nombres:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p >  
                        {{ $usuario->nombres }}
                    </p>
              </div> 
        </div>
        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('genero','Género:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p >  
                        {{ $usuario->genero_title }}
                    </p>
              </div> 
        </div>

        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('rol','Rol:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p>  
                        
                            {{ $usuario->rol_title }}
                        
                        
                        
                    </p>
              </div> 
        </div>

        
        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('registrado','Registrado:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p >  
                        Desde el {{$usuario->created_at->format('j').' de '.$usuario->created_at->format('M').' del '.$usuario->created_at->format('Y') }}
                    </p>
              </div> 
        </div>
        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('estado','Estado:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p >  
                        {{ $cuenta->estado->estado }}
                    </p>
              </div> 
        </div>
        <div class="row">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('sociallogin','Social login:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p>
                        @if($cuenta->bandera_social==true)
                            Si, ingresó con red social
                        @else
                           Ingresó por correo
                        @endif  
                        
                    </p>
              </div> 
        </div>
    </div><!--fin panel informacion admin izquierda-->
    
    <div class="col-xs-12 col-sm-offset-1 col-sm-4 panel-informacion-admin espacio-superior-peq">
        <label class="texto-azul espacio-superior-peq">Historial de sus anuncios y denuncias</label>

        
        



        <div class="row linea-separadora espacio-superior-peq">
            <p class="informacion-adicional">Anuncios que ha creado</p>
            <div class="col-xs-12 col-sm-9">
                {{ Form::label('anuncioscreados','Anuncios creados:') }}
            </div>
             
            <div class="col-xs-12 col-sm-3">
              <p>
                {{$usuario->anuncios->count()}}
              </p>
            </div> 
        </div>
        
        <div class="row linea-separadora">
            <p class="informacion-adicional">Anuncios propios bloqueados</p>
            <div class="col-xs-12 col-sm-9">
                {{ Form::label('anunciosbloqueados','Anuncios bloqueados:') }}
            </div>
            
            <div class="col-xs-12 col-sm-3">
                @if($usuario->historial) 
                    <p>{{ $usuario->historial->anunciosbloqueados }}</p>
                @else
                    <p> 0</p>
                @endif
            </div> 
        </div>

        <div class="row linea-separadora">
              <p class="informacion-adicional">Comentarios propios bloqueados</p>
              <div class="col-xs-12 col-sm-9">
                  {{ Form::label('comentarioseliminados','Comentarios bloqueados:') }}
              </div>
             
              <div class="col-xs-12 col-sm-3">
                        @if($usuario->historial) 
                            <p>{{ $usuario->historial->comentarioseliminados }}</p>
                        @else
                            <p> 0</p>
                        @endif
              </div> 
                  
        </div>
            
            <div class="row linea-separadora">
                     
                 
                    <p class="informacion-adicional">Denuncias correctas realizadas como usuario</p>
                 
                 <div class="col-xs-12 col-sm-9">
                      
                      {{ Form::label('denunciasverdaderas','Denuncias verdaderas:') }}
                            
                  </div>
             
                  <div class="col-xs-12 col-sm-3">
                        @if($usuario->historial) 
                            <p>{{ $usuario->historial->denunciasverdaderas }}</p>
                        @else
                            <p> 0</p>
                        @endif
                  </div> 
                  
            </div>
            <div class="row">
                     
                 
                    <p class="informacion-adicional">Denuncias falsas realizadas como usuario</p>
                 
                 <div class="col-xs-12 col-sm-9">
                      
                      {{ Form::label('denunciasfalsas','Denuncias falsas:') }}
                            
                  </div>
             
                  <div class="col-xs-12 col-sm-3">
                        @if($usuario->historial) 
                            <p>{{ $usuario->historial->denunciasfalsas }}</p>
                        @else
                            <p> 0</p>
                        @endif
                  </div> 
                  
            </div>

            <div class="row">
                <p class="informacion-adicional">El contador de denuncias debe ser menor a 20</p>
                <div class="col-xs-12 col-sm-9">
                    {{ Form::label('contadordedenuncias','Contador de denuncias:') }}
                </div>
             
                <div class="col-xs-12 col-sm-3">
                    @if($usuario->historial) 
                      <p>{{ $usuario->historial->denunciasfalsas-$usuario->historial->denunciasverdaderas }}</p>
                    @else
                      <p> 0 </p>
                    @endif
                </div> 
            </div>


    </div><!--fin panel informacion admin derecha-->
    


    @if($cuenta->estado->estado=="bloqueado")
    <div class="col-xs-12  col-sm-offset-4 col-sm-4 espacio-superior-peq">
                    <a href="" data-toggle="modal" data-target="#modalenviarcorreocuentabloqueada"  class="btn col-xs-12 btn-warning btn-sm  espacio-superior-min" title="Enviar correo automatizado">
                      
                      Enviar correo automatizado
                    </a>

    </div>
    @endif

    @if($cuenta->estado->estado=="desactivado")
    <div class="col-xs-12  col-sm-offset-4 col-sm-4 espacio-superior-peq">
                    <a href="" data-toggle="modal" data-target="#modalenviarcorreocuentadesactivada"  class="btn col-xs-12 btn-warning btn-sm  espacio-superior-min" title="Enviar correo automatizado">
                      
                      Enviar correo automatizado
                    </a>

    </div>

     <div class="col-xs-12  col-sm-offset-4 col-sm-4 espacio-superior-peq">
     <a data-toggle="modal" data-target="#activarcuentausuario" class="btn btn-info col-xs-12 btn-sm espacio-superior-min" title="Activar cuenta de usuario">
                    
                    </span>
                     Activar cuenta 
              </a>
    </div>
    @endif

   
    <div class="col-xs-12  col-sm-offset-4 col-sm-4 espacio-superior-peq">
                    <a href="" data-toggle="modal" data-target="#eliminarmensajecontactanos"  class="btn col-xs-12 btn-danger btn-sm espacio-superior-min" title="Eliminar mensaje de contáctanos">
                      
                      Eliminar mensaje
                    </a>

    </div> 



    <div class="col-xs-12 espacio-superior-peq">
          <div class="row">
              <a href="{{route('admin.msmcontactanos')}}" class="btn btn-primary col-xs-12 col-sm-offset-4 col-sm-4 ">
              <i class="icon-circle-arrow-left">
              </i>
                Ir a contáctanos
            </a>
          </div>

        
    </div>
</div><!--fin row inicial-->
@include('modales.modalenviarcorreocuentabloqueada')
@include('modales.modalenviarcorreocuentadesactivada')
@include('modales.modaleliminarmensajecontactanos')
@include('modales.modalactivarcuentausuario')
</div><!--fin contenedor interno-->
@stop

