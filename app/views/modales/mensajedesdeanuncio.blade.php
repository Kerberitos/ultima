 <div class="modal fade" id="mensajedesdeanuncio" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-envelope-2"></span> Envie un mensaje al anunciante</h4>
            </div>
            <form action="{{route('enviarmensaje')}}" method="post" accept-charset="utf-8">
                <div class="modal-body" style="padding: 5px;">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p class="informacion-adicional">Puede escribir aún <span id="max-length-mensaje">150</span> caracteres.</p>
                            <textarea style="resize:vertical" class="form-control" placeholder="Escriba su mensaje aquí, mínimo 10 y máximo 150 caracteres" rows="4" name="mensaje" maxlength="150" id="descripcion-mensaje" data-validation="required length" data-validation-length="min10" data-validation-error-msg-required="Ingrese el contenido de su mensaje, mínimo 10 caracteres"
                            data-validation-error-msg-length="Mínimo 10 caracteres" required></textarea>
                        </div>

                         
                    

                    </div>
                
            @if (Auth::check())
                @if(is_admin()) 
                <div class="form-group">
                    {{ Form::label('estado', 'Enviar como:', ['class'=>'control-label']) }} 
                        <div>
                             <select class="form-control" name="remitente_rol"  data-validation-error-msg="Seleccione un estado">
                                
                                
                                <option value="A">Administrador</option>

                            @if(is_super())
                                <option value="S">Super administrador</option>
                            @endif

                                <option value="U">Usuario</option>

                            </select>
                            
                        </div>
                        {{ $errors->first('estado', '<p class="alert alert-danger errores">:message </p>') }}
                </div>
                @endif
            @endif
                </div>  
                <input id="oculto" type="hidden" name="usuario_id" value={{ $anuncio->usuario_id }}/>
                <input id="oculto" type="hidden" name="anuncio_id" value={{ $anuncio->id }}/>
                <input id="oculto" type="hidden" name="mensaje_previo" value="0"/>
                <input id="oculto" type="hidden" name="previodate" value="0">


                <div class="modal-footer" style="margin-bottom:-14px;">
                    <input type="submit" class="btn btn-primary" value="Enviar"/>
                        <!--<span class="glyphicon glyphicon-ok"></span>-->
                        
                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts2')
    <script>

    
       $.validate({
            form : '#mensajedesdeanuncio',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            //errorMessageClass:'errorsito-msm',
           
            onSuccess : function() {
                //alert('El formulario es valido');
                //return false; // Will stop the submission of the form

                $('#mensajedesdeanuncio').find('[type="submit"]').text('Enviando...').addClass('disabled');
                
            },

 
        });
    </script>

    <script>
         $('#descripcion-mensaje').restrictLength( $('#max-length-mensaje') );

    </script>

@stop