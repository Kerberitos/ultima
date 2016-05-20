@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Detalle de contacto</h4>
    </div>

    @if (Session::has('status_error'))
      <p class="alert alert-danger alert-size">{{Session::get('status_error')}} </p>
      @endif
      @if (Session::has('status_ok'))
      <p class="alert alert-success alert-size">{{Session::get('status_ok')}} </p>
    @endif

<div class="row">
    
    <div class="col-xs-12  col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4 panel-informacion-contacto espacio-superior-peq">
        <div class="text-center">
            <label class="texto-azul espacio-superior-peq">Información de contacto</label>  
            
            <div class="foto-vercontacto">
                <img src="{{ asset('assets/images/usuario_hombre.png')}}" class="img-responsive" alt="">
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
                        {{ $contacto->nombre }}
                    </p>
              </div> 
        </div>

      

         <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('celular','Celular:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p >  
                        {{ $contacto->celular }}
                    </p>
              </div> 
        </div>
        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('telefono','Teléfono:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p >  
                        {{ $contacto->telefono }}
                    </p>
              </div> 
        </div>

        


    
        <div class="row linea-separadora">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('nota','Nota:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p class="lbl-detalle-correo">  
                        {{ $contacto->nota }}
                    </p>
              </div> 
        </div>
       

        
        
        <div class="row">
              <div class="col-xs-12 col-sm-3">
                  {{ Form::label('agregado','Añadido:') }}
              </div>
         
              <div class="col-xs-12 col-sm-9">
                    <p >  
                        El {{$contacto->created_at->format('j').' de '.$contacto->created_at->format('M').' del '.$contacto->created_at->format('Y') }}
                    </p>
              </div> 
        </div>
       
        <div class="col-xs-12 col-sm-12 col-sm-offset-2 col-sm-8 ">
          <a href="" data-toggle="modal" data-target="#eliminarcontacto"  class="btn col-xs-12 btn-danger btn-sm btn-separado espacio-superior-min" title="Eliminar contacto">
            <i class="icon-minus">
            </i>
              Eliminar contacto  
          </a>
        </div>


    </div><!--fin panel informacion admin izquierda-->
    <div class="col-xs-12">
          <div class="row">
              <a href="{{route('miagenda')}}"  class="btn btn-primary col-xs-12 col-sm-offset-4 col-sm-4 espacio-superior-peq" title=""><span class="glyphicon glyphicon-menu-left"> </span> Regresar</a>
          </div>

        
    </div>
</div><!--fin row inicial-->

</div><!--fin contenedor interno-->
@include('modales.modaleliminarcontacto')
@stop