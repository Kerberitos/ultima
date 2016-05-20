<fieldset>
	<legend>Información adicional</legend>
		<div class="form-group">
           	{{ Form::label('estado', '* Estado') }} 
				<div>
                     <select class="form-control" name="estado" data-validation="required" data-validation-error-msg="Seleccione estado" required>
                       	
                       	@if($anuncio->estado=="nuevo")
                       		<option value="usado">Usado</option>
                       		<option value="nuevo" selected>Nuevo</option>

                       	@elseif($anuncio->estado=="usado")
                       		<option value="usado" selected>Usado</option>
                       		<option value="nuevo">Nuevo</option>
                       	@endif
                       	
                   	


                   	</select>
					
				</div>
				{{ $errors->first('estado', '<p class="alert alert-danger errores">:message </p>') }}
		</div>

		<div class="form-group ">
			{{ Form::label('valor','* Precio') }}
				<div class="input-group">
					<span class="input-group-addon">$</span>
					{{ Form::text('valor',Input::old('valor'),
						[
							'class' => 'form-control',
							'id'=>'validate-number',
							'title'=>'Debe introducir el valor o sueldo',
							'placeholder' => 'Solo números enteros', 
							'required' => 'required',

							'data-validation'=>"required length number",
							
							'data-validation-length'=>"max10",

							'data-validation-error-msg-required'=>"Ingrese un precio, solo números",
							'data-validation-error-msg-number'=>"Ingrese solo números",
							'data-validation-error-msg-length'=>"Máximo 10 digitos",




						])
					}}
					
				</div>
				{{ $errors->first('valor', '<p class="alert alert-danger errores">:message </p>') }}
		</div>

		<div class="form-group">
    		<div>
		       	<select class="form-control" name="opcionvalor" data-validation="required" data-validation-error-msg="Seleccione un tipo" required>



                       	@if($anuncio->opcionvalor=="negociable")
                       			<option value="negociable" selected>Negociable</option>
		           				<option value="fijo">Fijo</option>

                       	@elseif($anuncio->opcionvalor=="fijo")
                       			<option value="negociable">Negociable</option>
		           				<option value="fijo" selected>Fijo</option>
                       	@endif
                       	
		           
		       	</select>
				
			</div>
			{{ $errors->first('opcionvalor', '<p class="alert alert-danger errores">:message </p>') }}
		</div>
</fieldset>