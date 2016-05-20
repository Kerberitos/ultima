<fieldset>
	<legend>Información del anuncio</legend>
	<div class="form-group">
		{{ Form::label('titulo','* Titulo', ['class'=>'control-label']) }}
		<div>
		{{ Form::text('titulo',Input::old('titulo'),
			[
				'class' => 'form-control',
				'id'=>'titulo-text',
				'title'=>'Título del anuncio',
				'placeholder' => 'Ejm: Vendo Tablet Samsung Galaxy Tab 2 de 7pulg ', 
				'required' => 'required',

				'data-validation'=>"required length",
				'data-validation-length'=>"30-100",
							
				'data-validation-error-msg-required'=>"Ingrese lo que desea anunciar",
				'data-validation-error-msg-length'=>"Mínimo 30 y máximo 100 caracteres",
			])
		}}
		</div>
		{{ $errors->first('titulo', '<p class="alert alert-danger errores">:message </p>') }}
	</div>
					
	<div class="form-group">
		{{ Form::label('descripcion','* Descripción', ['class'=>'control-label']) }}
		<div>
		<p class="informacion-adicional">Puede escribir aún <span id="max-length-element">500</span> caracteres.</p>
					
		{{ Form::textarea('descripcion', null, 
			[
				'class' => 'form-control', 
				'size' => '10x10',
				'maxlength'=>'500',

				'id'=>'descripcion-text',
				'placeholder'=>'Describe lo mejor posible tu anuncio, mínimo 30 caracteres y máximo 500', 
				'required'=>'required',

				'data-validation'=>"required length",
				'data-validation-length'=>"min30",

				'data-validation-error-msg-required'=>"Ingrese una descripción de su anuncio, mínimo 30 caracteres",
				'data-validation-error-msg-length'=>"Mínimo 30 caracteres",
			]) 
		}}
		</div>
		{{ $errors->first('descripcion', '<p class="alert alert-danger errores">:message </p>') }}  
	</div>
</fieldset>	
