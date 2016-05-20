 <div class="modal fade" id="bloquearanuncio" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-info-sign"></span> Bloquear anuncio </h4>
            </div>
            <form action="{{route('admin.bloquearanuncio')}}" method="post" accept-charset="utf-8" novalidate>
                <div class="modal-body" style="padding: 5px;">
                   
                    <div class="row">
                        <div class="col-xs-12">
                        {{ Form::label('politica', 'Motivo de bloqueo:', ['class'=>'control-label']) }} 
                        <div>
                             <select class="form-control" name="politica_id"  data-validation-error-msg="Seleccione un estado">
                                
                                
                                <option value="1">Política 1</option>
                                <option value="2">Política 2</option>
                                <option value="3">Política 3</option>
                                <option value="4">Política 4</option>
                                <option value="5">Política 5</option>
                                <option value="6">Política 6</option>
                                <option value="7">Política 7</option>
                                
                            </select>
                            
                            </div>
                            {{ $errors->first('politica_id', '<p class="alert alert-danger errores">:message </p>') }}
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            {{ Form::label('justificacion', 'Justifique el porqué boquear anuncio:', ['class'=>'control-label espacio-superior-peq']) }} 

                             <p class="informacion-adicional">Puede escribir aún <span id="max-length-bloquearanuncio">100</span> caracteres.</p>
                            <textarea style="resize:vertical;" class="form-control" placeholder="Detalle el motivo de la denuncia, mínimo 10 caracteres y máximo 100" rows="3" name="justificacion" maxlength='101' id='descripcion-bloquearanuncio' data-validation="required length" data-validation-length="min10" data-validation-error-msg-required="Ingrese el motivo de su denuncia, mínimo 10 caracteres"
                data-validation-error-msg-length="Mínimo 10 caracteres" required novalidate="true"></textarea>
                        </div>
                    </div>
                </div>  
               <input id="oculto" type="hidden" name="accion" value="bloqueado">
                <input id="oculto" type="hidden" name="anuncio_id" value={{ $anuncio->id }}>

                
                <div class="panel-footer">
                    <input type="submit" class="btn btn-danger" value="Bloquear"/>
                       
                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts10')
    <script>
       $.validate({
            form : '#bloquearanuncio',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            //errorMessageClass:'errorsito-msm',
             onSuccess : function() {
                
                //return false; // Will stop the submission of the form
                $('#bloquearanuncio').find('[type="submit"]').text('Enviando...').addClass('disabled');
            },
        });
    </script>
    <script>
         $('#descripcion-bloquearanuncio').restrictLength( $('#max-length-bloquearanuncio') );
    </script>
@stop