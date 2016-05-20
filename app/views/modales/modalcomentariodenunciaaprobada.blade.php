 <div class="modal fade" id="aprobardenunciadecomentario" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-cancel"></span> Comentario realmente incumple políticas</h4>
            </div>
            <form action="{{route('aprobardenunciacomentario')}}" method="post" accept-charset="utf-8">
                <div class="modal-body" style="padding: 5px;">
                   
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <label>La denuncia ha sido verificada</label>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>{{Auth::user()->usuario->nombres}}, ¿has constatado si el comentario denunciado realmente incumple alguna política de Miradita? y de ser así deseas bloquearlo, entonces  presiona bloquear</p>
                        </div>
                    </div>
                </div>  
                
                <input id="oculto" type="hidden" name="denunciante_id" value={{ $denuncia->denunciante_id}}/>
                <input id="oculto" type="hidden" name="denunciado_id" value={{ $denuncia->denunciado_id}}/>

                <input id="oculto" type="hidden" name="comentario_id" value={{ $comentario->id}}/>

                <div class="panel-footer">
                    <input type="submit" class="btn btn-danger" value="Bloquear"/>
                       
                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
