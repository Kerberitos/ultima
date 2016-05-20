 <div class="modal fade bs-example-modal-sm" id="modalenviarcorreocuentabloqueada" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-envelope-2"></span> Enviar correo electrónico automatizado</h4>
            </div>
            
            <div class="modal-body" style="padding: 5px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p> Desea enviar un mensaje de correo electrónico a {{$cuenta->correo}} con el siguiente mensaje:</p>
                        <p> {{$usuario->nombres}} su cuenta de usuario en Miradita Loja se encuentra bloqueada, debido a que 

                        @if($cuenta->estado->estado=="bloqueado")
                          
                              

                                @if($usuario->historial)

                                    @if($usuario->historial->anunciosbloqueados >=3 )
                                        modificó tres de sus anuncios ya publicados con contenido que infringe las normas de uso, no se permite a un usuario más de tres anuncios bloqueados.</p>
                                    
                                    @elseif(($usuario->historial->denunciasfalsas -$usuario->historial->denunciasverdaderas)>=10 )
                                        abusó del sistema de denuncias, realizando denuncias falsas repetida e innecesariamente.</p>  
                                    @elseif($usuario->historial->comentarioseliminados>=3)
                                        realizó tres comentarios con contenido que incumple alguna norma de uso.</p>

                                    @endif

                                @endif
                          


                         @endif






                    </div>
                </div>
            </div>  
                
                

            <div class="modal-footer">
                <a href="{{route('enviar.respuesta.contactanos', [$usuario->id, $mensaje->id])}}" title="Enviar correo automatizado" class="btn btn-warning btn-enviarcorreoautomatizado">Enviar </a>  
                <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar
                </button>
            </div>
            
        </div>
    </div>
</div>
