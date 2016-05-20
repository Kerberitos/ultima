@extends('layout')
@section('contenido')
<div class="contenedor-interno">
<div class="text-center">
    <h3>Anuncios clasificados subcategoría {{strtolower($subcategoria->subcategoria)}}</h3>
</div>
<div class="row">
    <div class="col-xs-12  col-sm-12 col-md-12 cabeza">
      <ol class="breadcrumb">
        <li><a href="{{ route('main') }}">Inicio</a></li>
        <li><a href="{{ route('verclasificados') }}">Clasificados</a></li>
         <li><a href="{{ route('clasificados.categoria.n',[$categoria->id]) }}">{{$categoria->categoria}}</a></li>
        <li class="active">{{$subcategoria->subcategoria}}</li>
      </ol>

    
    </div><!--fin cabeza--> 

     @if (sizeof($anuncios)==0)
         <div class="col-xs-12">
            <p class="alert alert-info"> Por el momento no hay anuncios en esta subcategoría</p>
          </div>
    @else
        
      <div class="contenedor-paginacion col-xs-12">
        
      
          <ul class="pagination pagination-sm">
              <li class="disabled"><a >Total <span class="hidden-xs">de anuncios</span>: {{$anuncios->getTotal() }}</a></li>
              <li class="disabled"><a >Pág<span class="hidden-xs">ina Nº</span> {{$anuncios->getCurrentPage() }} de {{$anuncios->getLastPage() }}</a></li>
          </ul>
      </div>
    @endif
  @foreach ($anuncios as $anuncio)
   <div class="col-xs-12 col-sm-4 col-md-4 cuadroproducto">
        <div class="row">
            <div class="col-xs-12">
              <?php $nombreseccion=$anuncio->seccion_title ?>

                <a href="{{ route('veranuncio',[ $nombreseccion, $anuncio->id ]) }}">
                  
                  <div class="col-xs-12 titulo-anuncios">

                      {{ mb_strtoupper(str_limit($anuncio->titulo,30)) }}

                  </div>
                </a>  
                <p class="acciongeneral-anunciante"> <span class="label label-info">Anunciante {{$anuncio->pregunta_title}}</span></p>

                 <p class="acciongeneral-anunciante"> <span class="label estado-producto-{{$anuncio->estado}}">ES {{ strtoupper($anuncio->estado)}}</span></p>


                <div class="col-xs-12 col-sm-8 precio-anuncios">
                    @if($anuncio->seccion_id==1)
                    <div>
                      <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                      <label> Precio: </label> $ {{ $anuncio->valor }} 
                    </div>
                    @endif
                    <label class="opcionvalor-anuncios"> {{strtoupper($anuncio->opcionvalor_title)}}</label>
                </div>
            </div>

            <div class="col-xs-6 col-sm-5">
                <a href="{{ route('veranuncio',[ $nombreseccion, $anuncio->id ]) }}">
                  @if($anuncio->imagen=="")
                      <img src="{{ asset('assets/images/anunciosinfoto.png')}}" class="img-responsive" alt="">
                  @else
                      <img src="{{ asset($anuncio->imagen) }}" class="img-responsive" alt="">
                  @endif       
                </a>

            </div>
                    
            <div class="col-xs-6 col-sm-7 anuncios-fecha">
                <div class="fechas-anuncio">
                  <label>Publicado el:</label>
                      {{$anuncio->publicaciondate->format('j/m/Y H:i')}}
                </div>
               
                
                  <div class="pull-left">
                    
                      <a href="{{ route('veranuncio',[ $nombreseccion, $anuncio->id ]) }}" class="botones-misanuncios btn btn-warning btn-xs" role="button">
                          <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                          VER ANUNCIO
                      </a>
                  </div>
               
            </div>
        </div><!--fin ROW-->
    </div><!--fin cuadro producto-->
    @endforeach
</div><!--fin row-->
    {{$anuncios->links() }}
    {{-- $anuncios->previous().' '.$anuncios->next() --}}
</div>
@stop

