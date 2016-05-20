<fieldset>
	<legend>Información adicional</legend>
		<div class="form-group ">
			{{ Form::label('valor','* Sueldo  estimado') }}
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
		       	<select class="form-control" name="tipo" data-validation="required" data-validation-error-msg="Seleccione un tipo de empleo"  required>
		           	<option value="">- Seleccione -</option>
		           	<option value="tiempocompleto">Tiempo completo</option>
		           	<option value="mediotiempo">Medio tiempo</option>
		           	<option value="temporal">Temporal</option>
		           	<option value="porhoras">Por horas</option>

		           	
		       	</select>
				
			</div>
			{{ $errors->first('tipo', '<p class="alert alert-danger errores">:message </p>') }}
		</div>
</fieldset>