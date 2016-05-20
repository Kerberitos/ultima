@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h4>Notificaciones que deben ser eliminadas</h4>
    </div>
    <div class="row">
        @if (Session::has('status_error'))
            <p class="alert alert-danger">{{Session::get('status_error')}} </p>
        @endif
        @if (Session::has('status_ok'))
            <p class="alert alert-success">{{Session::get('status_ok')}} </p>
        @endif

        @if (sizeof($notificaciones)==0)
                <div class="col-xs-12">
                        <p class="alert alert-info alert-size">No hay notificaciones expiradas</p>
                    </div>
        @else

        <div class="col-xs-12">
            <ul class="pagination pagination-sm">
                <li class="disabled"><a >Notificaciones <span class="hidden-xs">expiradas</span>: {{$numeroExpiradas }}</a></li>
                
            </ul>
        </div>
        
        <div class="col-xs-12">
        <p class="alert alert-info alert-size"> Hay un total de {{$numeroExpiradas }} notificaciones expiradas. Puede eliminar estas notificaciones expiradas </p>
        </div>


        <div class="col-xs-12 col-md-12">
             <a data-toggle="modal" data-target="#eliminarnotificacionesexpiradas"  title="Elimina todas las notificaciones expiradas" class="btn btn-danger btn-sm espacio-inferior-peq">Eliminar notificaciones</a>


            <?php $i=1  ?>
          <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        
                        
                        <th>ID</th>
                        <th>Notificación</th>
                        <th>Tipo de notificación</th>
                        <th>Revisión de usuario</th>
                        <th>Fecha expira</th>
                        
                       
                        
                    </tr>
                </thead>
              
                <tbody>
                     @foreach ($notificaciones as $notificacion)
                      
                            <tr class="warning">
                                <td>{{ $i++ }}</td>
                               
                                <td>{{ $notificacion->id }}</td>
                                
                                <td>{{ $notificacion->notificacion }}</td>
                                 <td>{{ $notificacion->tipo }}</td>
                                 <td>{{ $notificacion->estatus_visto }}</td>
                                <td>{{ $notificacion->expiradate }}</td>
                                
                                
                            </tr>
                            
                    @endforeach          
            </table>
        </div> 
      
              
        </div>
                   
        @endif
    </div>
</div><!--fin contenedor interno-->
@include('modales.modaleliminarnotificacionesexpiradas')
@stop