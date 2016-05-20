<fieldset>
	<legend>Información adicional</legend>
		<div class="form-group ">
			{{ Form::label('valor','* Sueldo  estimado') }}
				<div class="input-group" data-validate="number">
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

							'data-validation-error-msg-required'=>"Ingrese un estimado, solo números",
							'data-validation-error-msg-number'=>"Ingrese solo números",
							'data-validation-error-msg-length'=>"Máximo 10 digitos",
						])
					}}
					
				</div>
				{{ $errors->first('valor', '<p class="alert alert-danger errores">:message </p>') }}
		</div>

		<div class="form-group">
			{{ Form::label('tipo','* Tipo') }}
    		<div>
		       	<select class="form-control" name="tipo" data-validation="required" data-validation-error-msg="Seleccione un tipo de empleo" required>
		           	

		           		@if($anuncio->tipo=="tiempocompleto")
                       		<option value="tiempocompleto" selected>Tiempo completo</option>
				           	<option value="mediotiempo">Medio tiempo</option>
				           	<option value="temporal">Temporal</option>
				           	<option value="porhoras">Por horas</option>

                       	@elseif($anuncio->tipo=="mediotiempo")
                       		<option value="tiempocompleto">Tiempo completo</option>
				           	<option value="mediotiempo" selected>Medio tiempo</option>
				           	<option value="temporal">Temporal</option>
				           	<option value="porhoras">Por horas</option>

                       	@elseif($anuncio->tipo=="temporal")
                       		<option value="tiempocompleto">Tiempo completo</option>
				           	<option value="mediotiempo">Medio tiempo</option>
				           	<option value="temporal" selected>Temporal</option>
				           	<option value="porhoras">Por horas</option>
                       	
                       	@elseif($anuncio->tipo=="porhoras")
                       			<option value="tiempocompleto">Tiempo completo</option>
					           	<option value="mediotiempo">Medio tiempo</option>
					           	<option value="temporal">Temporal</option>
					           	<option value="porhoras" selected>Por horas</option>
                       	@endif
		       	</select>
				
			</div>
			{{ $errors->first('tipo', '<p class="alert alert-danger errores">:message </p>') }}
		</div>
</fieldset>