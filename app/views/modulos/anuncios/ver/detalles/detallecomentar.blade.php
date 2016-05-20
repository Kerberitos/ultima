<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10" id="comentar">
	
	<div id="mensaje">
				</div>


	<label>Puede realizar una pregunta o comentario sobre el anuncio</label>
	{{ Form::open(array(
		'action'=>'ComentarioController@comenta',
		'method'=>'POST',
		'role'=>'form',
		'id'=>'form',
		'novalidate'
		))
	}}
	<div>
		<p class="informacion-adicional">Puede escribir aún <span id="max-length-element">150</span> caracteres.</p>

		<div>
        {{ Form::textarea('comentario', Input::old('comentario'), 
        					array(

        						'class'=>'form-control', 
        						'placeholder'=>'Escriba su pregunta o comentario aquí', 
        						'size' => '2x2',
        						'maxlength'=>'150',
        						'id'=>'descripcion-text',
        						'data-validation'=>"length",
								'data-validation-length'=>"min10",
								'data-validation-error-msg-length'=>"Mínimo 10 caracteres",

        						)
        					) 

        }}
        </div>    
        
                   
        <input id="anuncio_id" type="hidden"  name="anuncio_id" value={{$anuncio->id}} >
				


		
		<div id="mensaje_estatuscomentar">
				</div>


		<div class="bg-danger text-danger" id="_comentario">{{ $errors->first('comentario')}}</div>

		
		{{Form::input('button', null, 'Enviar comentario', array('class'=>'btn btn-success col-xs-12','id'=>'enviarcomentario'))}}      
    </div>	
		{{ Form::close()}}
		<div id="img-cargando">
			<img src="{{ asset('assets/images/loading.gif')}}">
		</div>
</div>

@section('scripts3')
	<script>
       $.validate({
            form : '#form',
            modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,
           
            onSuccess : function() {
            	

               alert('fffue');
      
            },

        });
    </script>

    <script>
    	 $('#descripcion-text').restrictLength( $('#max-length-element') );
	</script>
@stop