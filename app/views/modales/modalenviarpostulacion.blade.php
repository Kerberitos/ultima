 <div class="modal fade bs-example-modal-sm" id="solicitudparaadministrador" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="panel panel-success">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-checkmark-2  hidden-xs"></span> Enviar solicitud</h4>
            </div>
            
            <div class="modal-body" style="padding: 5px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p> ¿Desea enviar la solicitud para ser administrador en Miradita Loja?</p>
                    </div>
                </div>
            </div>  
                
                

            <div class="modal-footer">
                <a href="{{ route('postular') }}" title="Aprobar anuncio" class="btn btn-success">Enviar </a>  
                <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar
                </button>
            </div>
            
        </div>
    </div>
</div>
