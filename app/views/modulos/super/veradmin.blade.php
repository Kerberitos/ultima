@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Información del administrador desde super</h4>
    </div>

<div class="row">

    <div class="col-xs-12  col-sm-offset-1 col-sm-5 panel-informacion-admin espacio-superior-peq">
        <label class="texto-azul espacio-superior-peq">Información general</label>

        <div class="row linea-separadora espacio-superior-peq">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('id_usuario','Id:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p>  
                        {{ $usuario->id }}
                    </p>
              </div> 
        </div>
        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('correo','Correo:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p class="lbl-detalle-correo">  
                        {{ $usuario->correo }}
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
                  {{ Form::label('telefono','Teléfono:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p>  
                        @if($usuario->telefono)
                            {{ $usuario->telefono }}
                        @else
                            No
                        @endif
                    </p>
              </div> 
        </div>

        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('celular','Celular:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p>  
                        @if($usuario->celular)
                            {{ $usuario->celular }}
                        @else
                            No
                        @endif
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
                        {{ $usuario->estado->estado }}
                    </p>
              </div> 
        </div>
        <div class="row">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('sociallogin','Social login:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p>
                        @if($usuario->bandera_social==true)
                            Si, ingresó con red social
                        @else
                            No, ingresó por correo
                        @endif  
                        
                    </p>
              </div> 
        </div>
    </div>
    
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
                <p class="informacion-adicional">Anuncios propios denunciados y bloqueados</p>
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
                 
                     
                 
                    <p class="informacion-adicional">Comentarios propios denunciados y bloqueados</p>
                 
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
    </div>

</div>
   
    <div class="col-xs-12 col-sm-offset-2 col-sm-8">

    	<a href="{{route('cancelar.admin',[$usuario->id])}}" title="" class="btn btn-danger col-xs-12">Dar de baja</a>
    </div>

</div><!--fin contenedor interno-->
@stop