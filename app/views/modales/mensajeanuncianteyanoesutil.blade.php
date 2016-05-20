 <div class="modal fade" id="mensajeanunciante" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-info-sign"></span> Envia un mensaje al anunciante</h4>
            </div>
            <form action="{{route('enviarmensajeanonimo')}}" method="post" accept-charset="utf-8">
                <div class="modal-body" style="padding: 5px;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                            <input class="form-control" name="nombre" placeholder="Tu nombre y apellido" type="text" required autofocus />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                            <input class="form-control" name="correo" placeholder="Tu correo" type="text" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <input class="form-control" name="asunto" placeholder="Asunto por el cual escribes" type="text" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <textarea style="resize:vertical;" class="form-control" placeholder="Escribe tu mensaje aquí" rows="6" name="mensaje" required></textarea>
                        </div>
                    </div>
                </div>  
                <input id="oculto" type="hidden" name="usuario_id" value={{ $anuncio->usuario_id }}/>
                <input id="oculto" type="hidden" name="anuncio_id" value={{ $anuncio->id }}/>
                <div class="panel-footer" style="margin-bottom:-14px;">
                    <input type="submit" class="btn btn-success" value="Enviar"/>
                        <!--<span class="glyphicon glyphicon-ok"></span>-->
                        <input type="reset" class="btn btn-danger" value="Limpiar" />
                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
