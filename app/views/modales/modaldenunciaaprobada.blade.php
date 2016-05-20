 <div class="modal fade" id="aprobardenuncia" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="icon-cancel"></span> Denuncia correcta</h4>
            </div>
            <form action="{{route('aprobardenuncia')}}" method="post" accept-charset="utf-8">
                <div class="modal-body" style="padding: 5px;">
                   
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <label>El anuncio SI incumple políticas</label>
                            
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                        {{ Form::label('politica', 'Motivo de bloqueo:', ['class'=>'control-label']) }} 
                        <div>
                             <select class="form-control" name="politica_id"  data-validation-error-msg="Seleccione un estado">
                                
                                
                                <option value="1">1. Alucinógenos, bebidas alcohólicas, o cualquier tipo de droga.</option>
                                <option value="2">2. Sustancias que contenga esteroides o anabolizantes.</option>
                                <option value="3">3. Medicamentos para la salud de humanos o animales.</option>
                                <option value="4">4. Servicio de acompañantes, prostitución o todo tipo de servicio sexual.</option>
                                <option value="5">5. Pornografía o contenido no apto para menores de edad.</option>
                                <option value="6">6. Cualquier tipo de discriminación.</option>
                                <option value="7">7. Información que promueva la violencia.</option>

                                <option value="8">8. Armas de fuego, municiones o material explosivo.</option>
                                <option value="9">9. Artículos o productos de dudosa procedencia.</option>
                                <option value="10">10. Software para vulnerar dispositivos electrónicos.</option>
                                <option value="11">11. Anuncio sobre préstamos o créditos financieros.</option>
                                <option value="12">12. Equipos para obtener servicios de forma gratuita siendo estos de paga.</option>
                                <option value="13">13. Ofrecer documentos personales de forma ilegal.</option>
                                <option value="14">14. Objetos considerados patrimonio histórico y cultural del Ecuador.</option>

                                <option value="15">15. Contenidos que promuevan peleas de animales.</option>
                                <option value="16">16. Fotografías donde se exhiban restos de animales.</option>
                                <option value="17">17. Venta de flora o fauna en peligro de extinción.</option>
                                <option value="18">18. Servicios para la realización de abortos.</option>
                                <option value="19">19. Servicios de realización de documentos estudiantiles.</option>
                                <option value="20">20. Boletos de lotería, rifas, bingos o máquinas de azar.</option>
                                <option value="21">21. Ofertas de trabajo donde no se detalle que trabajo se realizaría.</option>
                                
                            </select>
                            
                            </div>
                            {{ $errors->first('politica_id', '<p class="alert alert-danger errores">:message </p>') }}
                            </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            {{ Form::label('justificacion', 'Justifique la razón de bloquear el anuncio:', ['class'=>'control-label espacio-superior-peq']) }} 

                             <p class="informacion-adicional">Puede escribir aún <span id="max-length-aprobardenuncia">100</span> caracteres.</p>
                            <textarea style="resize:vertical;" class="form-control" placeholder="Detalle el motivo de la denuncia, mínimo 10 caracteres y máximo 100" rows="3" name="justificacion" maxlength='101' id='descripcion-aprobardenuncia' data-validation="required length" data-validation-length="min10" data-validation-error-msg-required="Ingrese el motivo de su denuncia, mínimo 10 caracteres"
                data-validation-error-msg-length="Mínimo 10 caracteres" required novalidate="true"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>{{Auth::user()->usuario->nombres}}, ¿ha constatado que el anuncio denunciado realmente incumple alguna política de uso?. Si desea bloquear este anuncio, presione bloquear</p>
                        </div>
                    </div>
                </div>  
                
                <input id="oculto" type="hidden" name="denunciante_id" value={{ $denuncia->denunciante_id}}>
                <input id="oculto" type="hidden" name="denunciado_id" value={{ $denuncia->denunciado_id}}>

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
            form : '#aprobardenuncia',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            //errorMessageClass:'errorsito-msm',
             onSuccess : function() {
                
                //return false; // Will stop the submission of the form
                $('#aprobardenuncia').find('[type="submit"]').text('Enviando...').addClass('disabled');
            },
        });
    </script>
    <script>
         $('#descripcion-aprobardenuncia').restrictLength( $('#max-length-aprobardenuncia') );
    </script>
@stop