 <div class="modal fade bs-example-modal-sm" id="modalcorreoautomatizado" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-envelope-2"></span> Enviar correo electrónico automatizado</h4>
            </div>
       
         <p id="ddd"> Desea enviar un mensaje de correo electrónico a {{$usuario->cuenta->correo}} con el siguiente mensaje:</p>
             
        @if($usuario->cuenta->estado->estado=="desactivado")   
            <div class="modal-body" style="padding: 5px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                       
                        <p> {{$usuario->nombres}} su cuenta de usuario en Miradita Loja se encuentra desactivada, en el momento que se registró un enlace de activación fue enviado a su correo electrónico, por favor, si no encuentra el mensaje en su bandeja de entrada revise en spam, o puede solicitar un nuevo enlace de activación.  
                       </p>
                    </div>
                </div>
            </div>  
        
        @elseif($usuario->cuenta->estado->estado=="bloqueado")

            @if($usuario->historial)
                <p> {{$usuario->nombres}} su cuenta de usuario en Miradita Loja se encuentra bloqueada, debido a que

                @if($usuario->historial->anunciosbloqueados >=$configuracion->anunciosbloqueados )
            
                    superó el número de anuncios bloqueados permitidos.</p>
                                    
                @elseif(($usuario->historial->denunciasfalsas -$usuario->historial->denunciasverdaderas)>=$configuracion->contadordedenuncias )
            
                    abusó del sistema de denuncias, realizando denuncias
                    falsas repetida e innecesariamente.</p>  
                
                @elseif($usuario->historial->comentarioseliminados>=$configuracion->comentarioseliminados)
                    superó el número de comentarios bloqueados permitidos.</p>

                @endif
            @endif
        @endif        
                

            <div class="modal-footer">
                <a href="{{route('enviar.correo.automatizado', [$usuario->id])}}" title="Enviar correo" class="btn btn-warning btn-enviarcorreoautomatizado">Enviar </a>  
                <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar
                </button>
            </div>
            
        </div>
    </div>
</div>
