 <div class="modal fade bs-example-modal-sm" id="modalenviarcorreocuentadesactivada" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-envelope-2"></span> Enviar correo electrónico automatizado</h4>
            </div>
            
            <div class="modal-body" style="padding: 5px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p id="ddd"> Desea enviar un mensaje de correo electrónico a {{$cuenta->correo}} con el siguiente mensaje:</p>
                        <p> {{$usuario->nombres}} su cuenta de usuario en Miradita Loja se encuentra desactivada, en el momento que se registró un enlace de activación fue enviado a su correo electrónico, por favor si no encuentra el mensaje en su bandeja de entrada revise en spam, o puede solicitar un nuevo enlace de activación.  
                       </p>
                    </div>
                </div>
            </div>  
                
                

            <div class="modal-footer">
                <a href="{{route('enviar.respuesta.contactanos', [$usuario->id, $mensaje->id])}}" title="Enviar correo" class="btn btn-warning btn-enviarcorreoautomatizado">Enviar </a>  
                <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar
                </button>
            </div>
            
        </div>
    </div>
</div>
