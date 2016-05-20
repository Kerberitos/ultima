 <div class="modal fade" id="escribirmensajeadmin" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-envelope-2"></span> Envía un mensaje</h4>
            </div>
            <form action="{{route('enviarmensaje')}}" method="post" accept-charset="utf-8">
                <div class="modal-body" style="padding: 5px;">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p class="informacion-adicional">Puede escribir aún <span id="max-length-element">150</span> caracteres.</p>
                            <textarea style="resize:vertical;" class="form-control" placeholder="Escriba su mensaje aquí, mínimo 10 y máximo 150 caracteres" rows="4" name="mensaje" maxlength='151' id='descripcion-text' data-validation="required length" data-validation-length="min10" data-validation-error-msg-required="Ingrese el contenido de su mensaje, mínimo 10 caracteres"
                data-validation-error-msg-length="Mínimo 10 caracteres" required></textarea>
                        </div>

                         
                    

                    </div>
                
            





                </div>  


                <input id="oculto" type="hidden" name="usuario_id" value={{ $usuario->id }}/>
                <input id="oculto" type="hidden" name="anuncio_id" value="0"/>
                <input id="oculto" type="hidden" name="mensaje_previo" value="0"/>
                <input id="oculto" type="hidden" name="remitente_rol" value='A'/>
                <input id="oculto" type="hidden" name="previodate" value="0">

                <div class="modal-footer" style="margin-bottom:-14px;">
                    <input type="submit" class="btn btn-success" value="Enviar"/>
                        <!--<span class="glyphicon glyphicon-ok"></span>-->
                        
                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
    <script>

    
       $.validate({
            form : '#escribirmensajeadmin',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            //errorMessageClass:'errorsito-msm',
           
            onSuccess : function() {
                //alert('El formulario es valido');
                //return false; // Will stop the submission of the form

                $('#escribirmensajeadmin').find('[type="submit"]').text('Enviando...').addClass('disabled');
                
            },

 
        });
    </script>

    <script>
         $('#descripcion-text').restrictLength( $('#max-length-element') );

    </script>

@stop