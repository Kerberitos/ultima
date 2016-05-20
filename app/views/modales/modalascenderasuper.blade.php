 <div class="modal fade bs-example-modal-sm" id="modalascenderasuper" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="panel panel-success">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-circle-arrow-up hidden-xs"></span> Ascender a super administrador</h4>
            </div>
            
            <div class="modal-body" style="padding: 5px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p> ¿Desea ascender a {{$usuario->nombres}} a super administrador? Obtendrá el máximo nivel de permisos dentro de Miradita Loja</p>
                    </div>
                </div>
            </div>  
                
                

            <div class="modal-footer">
                <a href="{{route('ascender.super', [$usuario->id])}}" title="ascender" class="btn btn-success">Ascender </a>  
                <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar
                </button>
            </div>
            
        </div>
    </div>
</div>
