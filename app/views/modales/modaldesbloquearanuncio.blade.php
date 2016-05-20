 <div class="modal fade" id="desbloquearanuncio" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="panel panel-success">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-checkmark-2"></span> Desbloquear anuncio </h4>
            </div>
            <form action="{{route('admin.desbloquearanuncio')}}" method="post" accept-charset="utf-8" novalidate>
                <div class="modal-body" style="padding: 5px;">
                   
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            {{ Form::label('justificacion', '¿Por qué desea desboquear este anuncio?', ['class'=>'control-label espacio-superior-peq']) }} 

                             <p class="informacion-adicional">Puede escribir aún <span id="max-length-desbloquearanuncio">100</span> caracteres.</p>
                            <textarea style="resize:vertical;" class="form-control" placeholder="Detalle el motivo de la denuncia, mínimo 10 caracteres y máximo 100" rows="3" name="justificacion" maxlength='101' id='descripcion-desbloquearanuncio' data-validation="required length" data-validation-length="min10" data-validation-error-msg-required="Ingrese el motivo de su denuncia, mínimo 10 caracteres"
                data-validation-error-msg-length="Mínimo 10 caracteres" required novalidate="true"></textarea>
                        </div>
                    </div>
                </div>  
               <input id="oculto" type="hidden" name="accion" value="desbloqueado">
                <input id="oculto" type="hidden" name="anuncio_id" value={{ $anuncio->id }}>

                
                <div class="panel-footer">
                    <input type="submit" class="btn btn-success" value="Desbloquear"/>
                       
                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts11')
    <script>
       $.validate({
            form : '#desbloquearanuncio',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            //errorMessageClass:'errorsito-msm',
             onSuccess : function() {
                
                //return false; // Will stop the submission of the form
                $('#desbloquearanuncio').find('[type="submit"]').text('Enviando...').addClass('disabled');
            },
        });
    </script>
    <script>
         $('#descripcion-desbloquearanuncio').restrictLength( $('#max-length-desbloquearanuncio') );
    </script>
@stop