 <div class="modal fade bs-example-modal-sm" id="modaldescenderaadministrador" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-circle-arrow-down hidden-xs"></span> Descender a Adminsitrador</h4>
            </div>
            
            <div class="modal-body" style="padding: 5px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p> ¿Desea descender al Super administrador {{$usuario->nombres}} a Administrador? {{$usuario->nombres}} obtendrá menos privilegios que los actuales</p>
                    </div>
                </div>
            </div>  
                
                

            <div class="modal-footer">
                <a href="{{route('descender.administrador', [$usuario->id])}}" title="Descender a usuario" class="btn btn-primary">Descender </a>  
                <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar
                </button>
            </div>
            
        </div>
    </div>
</div>
