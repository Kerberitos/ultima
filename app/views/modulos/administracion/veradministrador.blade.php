@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Detalles de administrador</h4>
    </div>

    @if (Session::has('status_error'))
      <p class="alert alert-danger alert-size">{{Session::get('status_error')}} </p>
      @endif
      @if (Session::has('status_ok'))
      <p class="alert alert-success alert-size">{{Session::get('status_ok')}} </p>
    @endif

<div class="row">
    
    <div class="col-xs-12  col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4 panel-informacion-admin espacio-superior-peq">
        <div class="text-center">
            <label class="texto-azul espacio-superior-peq">Información de administrador</label>  
            
            <div class="foto-veradministrador">
          
        
              @if($usuario->foto)
                <img src="{{ asset($usuario->foto) }}" class="img-responsive" alt="">

              @else
                @if($usuario->genero=='male')
                  <img src="{{ asset('assets/images/usuario_hombre.png')}}" class="img-responsive" alt="">
                @else
                  <img src="{{ asset('assets/images/usuario_mujer.png')}}" class="img-responsive" alt="">
                @endif
              @endif
            </div>

        </div>
        

        <div class="row linea-separadora espacio-superior-peq">
          
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
                  {{ Form::label('rol','Rol:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p>  
                      @if($usuario->rol_id==1)
                        <span class="label label-primary texto-blanco text-center">
                          {{ $usuario->rolvistoso_title}}
                        </span> 
                      @elseif($usuario->rol_id==2)
                        <span class="label label-warning texto-blanco text-center">
                          {{ $usuario->rolvistoso_title}}
                        </span> 


                      @elseif($usuario->rol_id==3)
                        <span class="label label-danger texto-blanco text-center">
                          {{ $usuario->rolvistoso_title}}
                        </span> 

                      @endif
                        
                    </p>
              </div> 
        </div>

         <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('estado','Estado:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p >  
                        {{ $usuario->cuenta->estado->estado }}
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

        


      @if (Auth::check())
        @if(is_super()) 
        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('correo','Correo:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p class="lbl-detalle-correo">  
                        {{ $usuario->cuenta->correo }}
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
       
        <div class="row  linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('sociallogin','Social login:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p>
                        @if($usuario->cuenta->bandera_social==true)
                            Si, ingresó con red social
                        @else
                            Ingresó por correo
                        @endif  
                        
                    </p>
              </div> 
        </div>


       @endif
      @endif   

     

      @if(\Auth::id()!= $usuario->id)
      <div class="col-xs-12 col-sm-12 col-sm-offset-2 col-sm-8 ">
          <a href="" data-toggle="modal" data-target="#escribirmensajeadmin"  class="btn col-xs-12 btn-warning btn-sm btn-separado espacio-superior-min" title="Enviar mensaje">
            <i class="icon-envelope-2 hidden-xs">
            </i>
            Enviar mensaje
          </a>

      </div>
      
          @if (Auth::check())
            @if(is_super()) 

              @if($usuario->rol_id!=3)
              <div class="col-xs-12 col-sm-12 col-sm-offset-2 col-sm-8 ">
                  <a href="" data-toggle="modal" data-target="#modalascenderasuper" class="btn col-xs-12 btn-success btn-sm btn-separado espacio-superior-min" title="Ascender a super administrador">
                    <i class="glyphicon glyphicon-circle-arrow-up hidden-xs">
                    </i>
                      Ascender a super admin  
                  </a>

              </div>
              @endif
               @if($usuario->rol_id==3)
                        <div class="col-xs-12 col-sm-12 col-sm-offset-2 col-sm-8 ">
                            <a href="" data-toggle="modal" data-target="#modaldescenderaadministrador"  class="btn col-xs-12 btn-primary btn-sm btn-separado espacio-superior-min" title="Asignar rol de usuario">
                              <i class="glyphicon glyphicon-circle-arrow-down hidden-xs">
                              </i>
                                Descender a administrador  
                            </a>
                        </div>
                @endif


              <div class="col-xs-12 col-sm-12 col-sm-offset-2 col-sm-8 ">
                  <a href="" data-toggle="modal" data-target="#modaldescenderausuario"  class="btn col-xs-12 btn-danger btn-sm btn-separado espacio-superior-min" title="Asignar rol de usuario">
                    <i class="glyphicon glyphicon-circle-arrow-down hidden-xs">
                    </i>
                      Descender a usuario  
                  </a>
              </div>



            @endif
          @endif
      @endif

    </div><!--fin panel informacion admin izquierda-->
    
   

    <div class="col-xs-12">
          <div class="row">
              <a href="{{route('lista.administradores')}}"  class="btn btn-primary col-xs-12 col-sm-offset-4 col-sm-4 espacio-superior-peq" title=""><span class="glyphicon glyphicon-menu-left"> </span> Regresar</a>
          </div>

        
    </div>
</div><!--fin row inicial-->
@include('modales.escribirmensajeadmin')
@include('modales.modalascenderasuper')
@include('modales.modaldescenderausuario')
@include('modales.modaldescenderaadministrador')
</div><!--fin contenedor interno-->

@stop