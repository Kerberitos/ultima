@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h3>Panel general de Administrador</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
                
                    <div class="row">
   
                        <div class="col-xs-12 col-sm-6 general-anuncios">
                            <p class="subtitulos-caja">ANUNCIOS</p>
                            <a href="{{route('admin.publicar')}}" class="btn btn-warning btn-md col-xs-12 col-sm-5" role="button">
                                <span class="glyphicon glyphicon-eye-open">
                                </span>
                                <p>Esperando  <span class="hidden-md"></span>revisión</p>
                               
                                        <span class="badge">
                                            {{ $anunciosPorRevisar }}
                                        </span>        
                      
                            </a>
                            <a href="{{route('admin.revisar.denuncias')}}" class="btn btn-danger btn-md col-xs-12 col-sm-offset-1 col-sm-5" role="button">
                                 <span class=" icon-bullhorn">
                                </span>
                                <p>Anuncios  <span class="hidden-md"></span>denunciados</p>
                                        <span class="badge">
                                            {{ $anunciosDenunciados }}
                                        </span> 
                                
                            </a>
                            
                            
                        </div>

                    
                        <div>
                            <div class="col-xs-12 col-sm-3 general-usuarios">
                                <p class="subtitulos-caja">BLOQUEADOS</p>
                                <a href="{{ route('admin.anuncios.bloqueados') }}" class="btn btn-info btn-md col-xs-12 col-sm-12" role="button">
                                <span class="icon-compass"></span>
                                <p>Anuncios  <span class="hidden-md"></span>bloqueados</p>
                                        <span class="badge"> 
                                            {{ $anunciosBloqueados }}
                                        </span>
                                </a>

                            </div>

                            <div class="col-xs-12 col-sm-3 general-usuarios">
                                <p class="subtitulos-caja">TAREAS PENDIENTES</p>
                                <a href="{{ route('admin.pendientes') }}" class="btn btn-success btn-md col-xs-12 col-sm-12" role="button">
                                <span class="icon-compass"></span>
                                <p>Tareas  <span class="hidden-md"></span>pendientes</p>
                                        <span class="badge"> 
                                            {{ $totalTareasPendientes }}
                                        </span>
                                
                                </a>

                            </div>
                        </div>



                        <div class="col-xs-12 col-sm-6 general-usuarios">
                            <p class="subtitulos-caja">COMENTARIOS Y RESPUESTAS</p>
                            <a href="{{route('admin.revisar.comentarios.denunciados')}}" class="btn btn-danger btn-md col-xs-12 col-sm-5" role="button">
                                <span class="icon-chat"></span> 
                                <p>Comentarios  <span class="hidden-md"></span>denunciados</p>
                                        <span class="badge">
                                            {{ $comentariosDenunciados }}
                                        </span>
                                
                            </a>

                             <a href="{{route('admin.revisar.respuestas.denunciadas')}}" class="btn btn-danger btn-md col-xs-12 col-sm-offset-1 col-sm-5" role="button">
                                 <span class=" icon-pencil-2">
                                </span>
                                <p>Respuestas <span class="hidden-md"></span>denunciadas</p>
                                        <span class="badge">
                                            {{ $respuestasDenunciadas }}
                                        </span>
                                
                            </a>




                            
                        </div>



                        <div>
                            <div>
                            <p class="subtitulos-caja">USUARIOS</p>
                            </div>
                            <div class="col-xs-12 col-sm-3 general-usuarios">
                            
                                <a href="{{route('admin.usuarios.bloqueados')}}" class="btn btn-info btn-md col-xs-12 col-sm-12" role="button">
                                <span class="icon-evil-2"></span> 
                                <p>Usuarios  <span class="hidden-md"></span>bloqueados</p>
                                        <span class="badge">
                                            {{ $usuariosBloqueados }}
                                        </span> 
                                
                                
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-3 general-usuarios">
                                <a href="{{route('admin.usuarios.desactivados')}}" class="btn btn-primary btn-md col-xs-12 col-sm-12" role="button">
                                <span class="icon-sad"></span> 
                                <p>Usuarios  <span class="hidden-md"></span>desactivados</p>
                                    <span class="badge">
                                        {{ $usuariosDesactivados }}
                                    </span> 
                                </a>
                            </div>
                        </div> 


                        
                        

                       

            </div><!--fin row-->
                   




               
           
        </div>
    



    </div><!--fin row-->

</div><!--fin contenedor interno-->
@stop