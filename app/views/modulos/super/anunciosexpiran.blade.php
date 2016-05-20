@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Anuncios que deben ser desactivados</h4>
    </div>
    <div class="row">
        @if (Session::has('status_error'))
            <p class="alert alert-danger">{{Session::get('status_error')}} </p>
        @endif
        @if (Session::has('status_ok'))
            <p class="alert alert-success">{{Session::get('status_ok')}} </p>
        @endif

        @if (sizeof($anuncios)==0)
                <div class="col-xs-12">
                        <p class="alert alert-info alert-size">No hay anuncios expirados</p>
                    </div>
        @else

        <div class="col-xs-12">
            <ul class="pagination pagination-sm">
                <li class="disabled"><a >Anuncios <span class="hidden-xs">expirados</span>: {{$numeroExpirados }}</a></li>
                
            </ul>
        </div>
        
        <div class="col-xs-12">
        <p class="alert alert-info alert-size"> Hay un total de {{$numeroExpirados }} anuncios expirados. Puede desactivar estos anuncios expirados </p>
        </div>


        <div class="col-xs-12 col-md-12">
            <a data-toggle="modal" data-target="#desactivaranunciosexpirados"    title="Desactivar anuncios expirados" class="btn btn-warning btn-sm espacio-inferior-peq">Desactivar anuncios</a>

            <?php $i=1  ?>
          <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        
                        
                        <th>ID</th>
                        <th>Titulo</th>
                        
                        <th>Fecha que han expirado</th>
                        
                       
                        
                    </tr>
                </thead>
              
                <tbody>
                     @foreach ($anuncios as $anuncio)
                      
                            <tr class="warning">
                                <td>{{ $i++ }}</td>
                               
                                <td>{{ $anuncio->id }}</td>
                                
                                <td>{{ $anuncio->titulo }}</td>
                                <td>{{ $anuncio->expiradate }}</td>
                                
                                
                            </tr>
                            
                    @endforeach          
            </table>
        </div>   
           
    
        </div>
                   



        @endif
               
    </div>
    
 

    

</div><!--fin contenedor interno-->
@include('modales.modaldesactivaranunciosexpirados')
@stop