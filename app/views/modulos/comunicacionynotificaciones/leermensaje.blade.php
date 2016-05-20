@extends('layout')
@section('contenido')
	
	<div class="contenedor-interno">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 espacio-superior-peq">
				<p class="texto-negrita linea-inferior">Mensaje enviado por 

				@if($mensaje->remitente_rol == 'U' | $mensaje->remitente_rol == 'A')
					{{ $remitente->nombres}}          
				@elseif($mensaje->remitente_rol == 'S')	
					Miradita Loja
				@endif
				
				</p>
				
				<div class="row linea-inferior">
				      <div class="col-xs-12 col-sm-3">
				          {{ Form::label('recibido','RECIBIDO:') }}
				      </div>
				 
				      <div class="col-xs-12 col-sm-7">
					        <p >  
					          {{$mensaje->created_at->format('l, j M Y H:i a')}} 
					        </p>
				      </div> 
			    </div>
				<div class="row">
				      <div class="col-xs-12 col-sm-3">
				          {{ Form::label('remitente','REMITENTE:') }}
				      </div>
				 
				      <div class="col-xs-12 col-sm-7">

				      	
				      	@if($mensaje->remitente_rol == 'U')
					          
					        <p>{{ $remitente->nombres }} ({{$remitente->cuenta->correo}})</p>
					        
					    @elseif($mensaje->remitente_rol == 'A')    
					    	<p>{{ $remitente->nombres }}</p>
					    	<p>(<span class="text-info">Administrador </span>)

					    @elseif($mensaje->remitente_rol == 'S')	
					   			@if(\Auth::user()->usuario->rol_id == 1)
					   				<p><span class="text-info">Comunidad Miradita Loja</span></p>
					   			@elseif(\Auth::user()->usuario->rol_id == 2)
					   				<p>{{ $remitente->nombres }}</p>
					   				<p>(<span class="text-info">Super administrador</span>)</p>
					   			@elseif(\Auth::user()->usuario->rol_id == 3)
					   				<p>{{ $remitente->nombres }}</p>
					   				<p>(<span class="text-info">Super administrador</span>)</p>
					   			@endif

					    @endif
					     
				      </div> 
			    </div>
			    

			    <div class="row cuadro-mensaje">
			    	

					<p>
						@if($mensaje->remitente_rol == 'U')
					          
					        <span class="texto-negro texto-negrita">
								{{ Helper::nombre_simple($remitente->nombres) }} escribió:
							</span>
					        
					    @elseif($mensaje->remitente_rol == 'A')    
					    	<span class="texto-negro texto-negrita">
								{{ Helper::nombre_simple($remitente->nombres) }} escribió:
							</span>

					    @elseif($mensaje->remitente_rol == 'S')	
					   			<span class="texto-negro texto-negrita">
									Miradita Loja escribió:
								</span>
					    @endif
					</p>


					<p>	{{$mensaje->mensaje}}</p>
					@if (!empty($mensaje->anuncio_id))
						@if (! empty($anuncio))
							
							@if($anuncio->estado_title == 'Publicado')

								<p class="informacion-adicional">El mensaje hace referencia a
									<a href="{{ route('veranuncio',[ $anuncio->seccion_title, $mensaje->anuncio_id ]) }}" class="enlace" target="_blank">este anuncio</a>
							
								</p>
							@else
								<p class="informacion-adicional">Mensaje hace referencia a un anuncio no disponible en este momento.</p>	
							@endif
						
						@elseif (empty($anuncio))
							<p class="informacion-adicional">Mensaje hace referencia a un anuncio que ya no está disponible</p>
						@endif
					@endif

					@if($mensaje->mensaje_previo!="0")
						<div class="row cuadro-mensajeprevio">

							<p>El {{$mensaje->previodate }},
								  usted escribió:
								  {{$mensaje->mensaje_previo}}
							</p>

							
						</div>

					@endif
				</div>
				
			</div>



			

			
		<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
			@if(Session::has('status_ok'))
				<p class="alert alert-success">{{Session::get('status_ok')}}</p>
			@endif


			<a href="" class="btn btn-success btn-xs" id="btn-mostrarespondermensaje" title="Responder mensaje">Responder</a>	
			<a href="" data-toggle="modal" data-target="#eliminarmensaje" title="Eliminar mensaje" class="btn btn-danger btn-xs" id="btn-eliminarmensaje" title="">Eliminar</a>	
		</div>	
		<form action="{{route('enviarmensaje')}}" class="panel-respondermensaje" method="post" accept-charset="utf-8" id="respondermensaje">	
			<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
				<p class="informacion-adicional">Puede escribir aún <span id="max-length-element">150</span> caracteres.</p>
                            <textarea style="resize:vertical;" class="form-control" placeholder="Escribe tu mensaje aquí, mínimo 10 caracteres y máximo 150" rows="4" name="mensaje" maxlength='151' id='descripcion-text' data-validation="required length" data-validation-length="min10" data-validation-error-msg-required="Ingrese el contenido de su mensaje, mínimo 10 caracteres"
                data-validation-error-msg-length="Mínimo 10 caracteres" required></textarea>




			</div>
			
			
             @if (Auth::check())
                @if(is_admin()) 
                <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
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
            
            





			<input id="oculto" type="hidden" name="usuario_id" value="{{ $mensaje->remitente_id }}">
            <input id="oculto" type="hidden" name="anuncio_id" value="{{ $mensaje->anuncio_id }}" >
			<input id="oculto" type="hidden" name="mensaje_previo" value="{{ $mensaje->mensaje }}" >
			<input id="oculto" type="hidden" name="previodate" value="{{$mensaje->created_at->format('l, j M Y H:i:s a')}}">

			<div class="col-xs-12  col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 pie">
				
		
				<button type="submit" class="btn col-xs-12 col-sm-5 btn-success espacio-superior-peq">
 			 		 Enviar
				</button>

				<a id="btncancelarrespondermensaje" class="btn btn-danger col-xs-12 col-sm-offset-2 col-sm-5 espacio-superior-peq">
        			Cancelar
      			</a>

				
			</div>
		</form>	

		<div class="col-xs-12  col-sm-offset-4 col-sm-4 col-md-offset-3 col-md-6 pie">
			<a href="{{route('mismensajes')}}" class="btn btn-primary col-xs-12 boton-cancelar">
        		<i class="icon-circle-arrow-left">
        		</i>
        			Ir a mensajes
      			</a>

      			
		</div>



		</div>
		@include('modales.modaleliminarmensaje')
	</div>
@stop
@section('scripts')
    <script>

    
       $.validate({
            form : '#respondermensaje',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
            //errorMessageClass:'errorsito-msm',
           
            onSuccess : function() {
                   $('#respondermensaje').find('[type="submit"]').text('Enviando...').addClass('disabled');
                
            },

 
        });
    </script>

    <script>
         $('#descripcion-text').restrictLength( $('#max-length-element') );

    </script>

@stop