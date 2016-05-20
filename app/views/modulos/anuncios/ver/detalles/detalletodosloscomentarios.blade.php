<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
	<div class="page-header">
    	<h4><small class="pull-right">{{count($comentarios)}} comentarios</small> Comentarios </h4>

        @if(! \Auth::check())
        	<p class="informacion-adicional">Debe tener una cuenta en Miradita e ingresar para poder comentar</p>
        @endif

    </div>

	<ul class="chat">
	@foreach ($comentarios as $comentario)
        <li class="left clearfix">
            <span class="chat-img pull-left">
            
	            @if($comentario->usuario->foto=="")
	            	@if($comentario->usuario->genero=='male')
						<img src="{{ asset('assets/images/usuario_hombre_min.png')}}" class="img-circle img-comentario" alt="">
					@else
						<img src="{{ asset('assets/images/usuario_mujer_min.png')}}" class="img-circle img-comentario" alt="">
					@endif
	          		
	       		@else
	       			<img src="{{ asset($comentario->usuario->foto) }}" class="img-circle img-comentario" alt="">
	       		@endif	

            </span>
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">{{$comentario->usuario->nombres}}</strong> 
                    <small class="pull-right text-muted">
                        <span class="glyphicon glyphicon-time"></span>{{$comentario->created_at->format('j/m/Y H:i a')}}
                    </small>
                </div>
                <p>
                    {{$comentario->comentario}}
                </p>
                
                @if($comentario->estatus=="denunciado")

                	<a class="btn btn-min btn-denunciado btn-default btn-xs" title="Ya ha sido denunciado">Denunciado</a>
                @else

                	@if( \Auth::check()   & $comentario->usuario_id!=\Auth::id())
	                <a class="btn btn-min btn-denunciar-comentario btn-xs" title="Reportar a un administrador" role="button" data-href="{{ route('denunciarcomentario',[ $comentario->id, $comentario->usuario_id ]) }}" data-toggle="modal" data-target="#denunciarcomentario">
	                            <span class="icon-notice-2" ></span>
	                            Denunciar
	                </a>
	                @endif

                @endif


                @if($comentario->usuario_id == \Auth::id())
                 <a class="btn btn-borrar-comentario btn-min btn-xs" title="Borrar comentario" role="button" data-href="{{ route('borrarcomentario',[ $comentario->id ]) }}" data-toggle="modal" data-target="#borrarcomentario">
                 	<span class="icon-minus-2" ></span>  
                    Borrar
                </a>
                @endif

	            <!--Nueva seccion de respuestas-->
	            	
		        <div class="caja-respuestas col-xs-12">
		            <ul class="respuestas listarespuesta_{{$comentario->id}}">
		              	@foreach ($comentario->respuestas as $respuesta)
				        	<li class="left clearfix">
		                        <div class="cajita-respuesta">
			                        <span class="chat-img pull-left">
							           

							        
							       		@if($respuesta->usuario->foto=="")
							            	@if($respuesta->usuario->genero=='male')
												<img src="{{ asset('assets/images/usuario_hombre_min.png')}}" class="img-circle img-respuesta" alt="">
											@else
												<img src="{{ asset('assets/images/usuario_mujer_min.png')}}" class="img-circle img-respuesta" alt="">
											@endif
							          		
							       		@else
							       			<img src="{{ asset($respuesta->usuario->foto) }}" class="img-circle img-respuesta" alt="">
							       		@endif	





							        </span>
			                        <div class="chat-respuesta clearfix">
			                            <div class="header">
			                                
			                            	@if($respuesta->usuario_id == $respuesta->comentario->anuncio->usuario_id)
			                                	<strong class="fuente-nombrecomentario"> Anunciante</strong> 

			                                @else
			                                	<strong class="fuente-nombrecomentario">{{$respuesta->usuario->nombres}}</strong> 
			                                @endif


			                                <small class="pull-right text-muted">
			                                    <span class="glyphicon glyphicon-time"></span>{{$respuesta->created_at->format('j/m/Y H:i a')}}
			                                </small>
			                            </div>
			                            <p>
							            	{{$respuesta->respuesta}}
							        	</p>


							        	@if($respuesta->estatus=="denunciado")

						                	<a title="Ya ha sido denunciado" class="btn btn-default btn-xs">Denunciado</a>
						                @else
						                	@if( \Auth::check()   & $respuesta->usuario_id!=\Auth::id())
								        	<a class="btn btn-min btn-denunciar-comentario btn-xs" title="Reportar a un administrador" role="button" data-href="{{ route('denunciarrespuesta',[ $respuesta->id, $respuesta->usuario_id ]) }}" data-toggle="modal" data-target="#denunciarrespuesta">
	                           					<span class="icon-notice-2" ></span>  
	                            				Denunciar respuesta
	                            				
	                						</a>
	                						@endif
                						@endif


                						@if($respuesta->usuario_id== \Auth::id())
							                 <a class="btn btn-borrar-comentario btn-min btn-xs" title="Borrar respuesta" role="button" data-href="{{ route('borrarrespuesta',[ $respuesta->id ]) }}" data-toggle="modal" data-target="#borrarrespuesta">
							                 	<span class="icon-minus-2" ></span>  
							                    Borrar respuesta
							                </a>
							            @endif



			                        </div>

			                        


		                        </div>
		                    </li>

			        	@endforeach
			        </ul>   
			    </div>			
		        <!--fin seccion de respuestas-->
		        @if(Auth::check())
			 	<div class="cajaresponder_{{$comentario->id}} col-xs-12 ocultisimo">
		          	<div>
						{{ Form::open(array(
							'action'=>'ComentarioController@respuesta',
							'method'=>'POST',
							'role'=>'form',
							'id'=>'formrespuesta_'.$comentario->id,
							'class'=>'formulariorespuestas',
							'novalidate'
							))
						}}	
						<p class="informacion-adicional">Mínimo 10 y máximo 150 caracteres.</p>
		                {{ Form::textarea('respuesta', Input::old('respuesta'), 
		                					array(
		                						'class'=>'form-control', 
		                						'placeholder'=>'Escriba su respuesta aquí'.$comentario->id.'', 
		                						'size' => '1x2',
		                						'id'=>'descripcion-comentario',

		                						'maxlength'=>'150',
				        						
				        						'data-validation'=>"length",
												'data-validation-length'=>"min10",
												'data-validation-error-msg-length'=>"Mínimo 10 caracteres",



		                						)
		                					) 


		            	}}
		            	 <div class="bg-danger" id="_respuesta">{{ $errors->first('respuesta')}}</div>


			                <input id="comentario_id" type="hidden"  name="comentario_id" value={{$comentario->id}} >
			                <input id="anuncio_id" type="hidden"  name="anuncio_id" value={{$comentario->anuncio_id}} >
			                <input id="usuario_id" type="hidden"  name="usuario_id" value={{$comentario->usuario_id}} >

						{{Form::input('button', null, 'Enviar respuesta', array('class'=>'btn btn-success col-xs-12 col-sm-3 btn-xs espacio-superior-min enviarrespuesta', 'data-title'=>$comentario->id))}} 
			            {{ Form::close()}}
			            	{{Form::input('button', 'cancelar', 'Cancelar', array('class'=>'btn btn-danger col-xs-12 col-sm-offset-1 col-sm-3 btn-xs espacio-superior-min cancelarespuesta'))}} 
		            </div>
		        </div>
		        @endif
		        @if(Auth::check())

		    	<div class="col-xs-12">
		            <a href="" data-title="{{$comentario->id}}" class="btn btn-success btn-xs respuesta pull-right"><span class=" icon-pencil-2" aria-hidden="true"></span> Responder{{$comentario->id}}</a>
			        <div class="respuesta-enviada{{$comentario->id}}">
		            </div>
		        </div>
		        @endif
	   		</div>
        </li>
    @endforeach
    </ul>	

    @include('modales.modaldenunciarcomentario')	
    @include('modales.modaldenunciarrespuesta')
    @include('modales.modalborrarcomentario')
    @include('modales.modalborrarrespuesta')
</div>	