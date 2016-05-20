 <div class="modal fade" id="rechazardenuncia" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="panel panel-info">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-checkmark-2"></span> Anuncio sin problemas</h4>
            </div>
            <form action="{{route('rechazardenuncia')}}" method="post" accept-charset="utf-8">
                <div class="modal-body" style="padding: 5px;">
                   
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <label>El anuncio NO infringe ninguna política</label>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>{{Auth::user()->usuario->nombres}}, después revisar el anuncio denunciado ha constatado que el anuncio no incumple ninguna política de uso y desea que el mismo pueda ser publicado nuevamente, entonces presione Activar </p>
                        </div>
                    </div>
                </div>  
                
                <input id="oculto" type="hidden" name="denunciante_id" value={{ $denuncia->denunciante_id}}/>
                 <input id="oculto" type="hidden" name="anuncio_id" value={{ $anuncio->id}}/>

                <div class="panel-footer">
                    <input type="submit" class="btn btn-info" value="Activar"/>
                       
                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
