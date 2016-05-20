 <div class="modal fade" id="modalagendaranunciante" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="panel panel-info">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-user-add"></span> Agregar anunciante a agenda</h4>
            </div>
            <form action="{{route('agendar')}}" method="post" accept-charset="utf-8">
                <div class="modal-body" style="padding: 5px;">
                    <div class="form-group">
                         <p>Se agregarán los nombres y teléfonos del anunciante a su agenda. Así podrá consultar esos datos más adelante, además puede adjuntar una pequeña nota.</p>
                        
                    </div>
              
                    <div class="row">


                       
                        <div class="col-lg-12 col-md-12 col-sm-12">
                             {{ Form::label('estado', 'Adjuntar nota:', ['class'=>'control-label']) }} 
                            <p class="informacion-adicional">Puede escribir aún <span id="max-length-agregar">50</span> caracteres.</p>
                            <textarea style="resize:vertical" class="form-control" placeholder="Para recordar el motivo de agregar a su agenda, puede adjuntar una nota" rows="2" name="nota" maxlength="50" id="descripcion-agregar" data-validation-optional="true" data-validation="length" data-validation-length="min5" data-validation-error-msg-required="Ingrese el contenido de su nota, mínimo 10 caracteres"
                            data-validation-error-msg-length="Mínimo 5 caracteres"></textarea>
                        </div>
                         
                         
                    

                    </div>
                
           
                
                </div>  
                
                <input id="oculto" type="hidden" name="anunciante_id" value="{{ $anuncio->anunciante->id }}">
                
                


                <div class="modal-footer">
                    <input type="submit" class="btn btn-info" value="Agregar"/>
                        <!--<span class="glyphicon glyphicon-ok"></span>-->
                        
                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts5')
    <script>

    
       $.validate({
            form : '#modalagendaranunciante',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            //errorMessageClass:'errorsito-msm',
           
            onSuccess : function() {
                //alert('El formulario es valido');
                //return false; // Will stop the submission of the form

                $('#modalagendaranunciante').find('[type="submit"]').text('Enviando...').addClass('disabled');
                
            },

 
        });
    </script>

    <script>
         $('#descripcion-agregar').restrictLength( $('#max-length-agregar') );

    </script>

@stop