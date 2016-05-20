 <div class="modal fade" id="aprobardenunciaderespuesta" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-cancel"></span> Respuesta realmente incumple normas</h4>
            </div>
            <form action="{{route('aprobardenunciarespuesta')}}" method="post" accept-charset="utf-8">
                <div class="modal-body" style="padding: 5px;">
                   
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <label>La denuncia ha sido verificada</label>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>{{Auth::user()->nombres}}, ¿has constatado si la respuesta denunciada realmente incumple alguna norma de miradita? y de ser así deseas bloquearla, entonces  presiona bloquear</p>
                        </div>
                    </div>
                </div>  
                
                <input id="oculto" type="hidden" name="denunciante_id" value={{ $denuncia->denunciante_id}}/>
                <input id="oculto" type="hidden" name="denunciado_id" value={{ $denuncia->denunciado_id}}/>

                <input id="oculto" type="hidden" name="respuesta_id" value={{ $respuesta->id}}/>

                <div class="panel-footer">
                    <input type="submit" class="btn btn-danger" value="Bloquear"/>
                       
                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
