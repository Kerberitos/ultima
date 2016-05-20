@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Anuncios ocupados por administradores</h4>
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
                        <p class="alert alert-info alert-size">No hay anuncios ocupados</p>
                    </div>
        @else

        <div class="col-xs-12">
            <ul class="pagination pagination-sm">
                <li class="disabled"><a >Anuncios <span class="hidden-xs">ocupados</span>: {{$numeroOcupados }}</a></li>
                
            </ul>
        </div>
        
        <div class="col-xs-12">
        <p class="alert alert-info alert-size"> Hay un total de {{$numeroOcupados }} anuncios ocupados. Puede liberar  estos anuncios ocupados </p>
        </div>


        <div class="col-xs-12 col-md-12">
            <a data-toggle="modal" data-target="#liberaranunciosocupados" title="Liberar anuncios ocupados" class="btn btn-warning btn-sm espacio-inferior-peq">Liberar anuncios</a>

            <?php $i=1  ?>
          <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Último acceso</th>
                    </tr>
                </thead>
              
                <tbody>
                     @foreach ($anuncios as $anuncio)
                      
                            <tr class="warning">
                                <td>{{ $i++ }}</td>
                               
                                <td>{{ $anuncio->id }}</td>
                                
                                <td>{{ $anuncio->titulo }}</td>
                                <td>{{ $anuncio->updated_at }}</td>
                                
                                
                            </tr>
                            
                    @endforeach
                </tbody>      
            </table>
        </div>   
           
    
        </div>
                   



        @endif
               
    </div>
    
 

    

</div><!--fin contenedor interno-->
@include('modales.modalliberaranunciosocupados')
@stop