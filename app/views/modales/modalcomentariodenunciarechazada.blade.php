 <div class="modal fade" id="rechazardenunciadecomentario" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="panel panel-info">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-checkmark-2"></span> Comentario no incumple ninguna política</h4>
            </div>
            <form action="{{route('rechazardenunciacomentario')}}" method="post" accept-charset="utf-8">
                <div class="modal-body" style="padding: 5px;">
                   
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <label>El comentario no infringe ninguna política</label>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>{{Auth::user()->usuario->nombres}}, después de la revisión has constatado que el comentario no incumple ninguna política de uso y deseas que el mismo siga siendo visualizado con normalidad, presiona Activar </p>
                        </div>
                    </div>
                </div>  
                
                <input id="oculto" type="hidden" name="denunciante_id" value={{ $denuncia->denunciante_id}}/>
                 <input id="oculto" type="hidden" name="comentario_id" value={{ $comentario->id}}/>

                <div class="panel-footer">
                    <input type="submit" class="btn btn-info" value="Activar"/>
                        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
