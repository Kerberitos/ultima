<fieldset>
 	<legend>Información del anunciante</legend>
 		<div class="form-group">
			{{ Form::label('anunciante','* Nombres del Anunciante', ['class'=>'control-label']) }}
			<p class="informacion-adicional">¿Por quién preguntar al llamar?</p>
			<div>
				{{ Form::text('anunciante', $usuario->nombres,
						[
							'class' => 'form-control',
							'title'=>'Nombre del anunciante',
							'placeholder' => 'Ejm: Edro Leal', 
							'required' => 'required',

							'pattern'=>"^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]{1,30}$",

							'data-validation'=>"required length custom",

							'data-validation-length'=>"8-30",
							'data-validation-regexp'=>"^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]{1,30}$",
							
									

							'data-validation-error-msg-required'=>"Ingrese nombre del anunciante",
							'data-validation-error-msg-length'=>"Mínimo 8 y máximo 30 caracteres",
							'data-validation-error-msg-custom'=>"Por favor solo letras",
							
						])
				}}
				
			</div>
			
			{{ $errors->first('anunciante', '<p class="alert alert-danger errores">:message </p>') }}
		</div>

		

		<div class="form-group">
			{{ Form::label('celular', '*Celular', ['class'=>'control-label']) }}      
       		<div>
				{{ Form::text('celular', $usuario->celular,
						[
							'class' => 'form-control',
							'title'=>'Debe introducir su celular',
							'placeholder'=>'Ejem: 09 6967 2916',
							'id'=>'celular',

							'data-validation'=>"required custom",

							'data-validation-regexp'=>"^0[0-9]{9}$",
							
									

							'data-validation-error-msg-required'=>"Ingrese un número de celular",

							'data-validation-error-msg-custom'=>"Debe iniciar con 0, solo 10 dígitos",
							


						])
				}}
				
			</div>
			
				{{ $errors->first('celular', '<p class="alert alert-danger">:message</p>')}}
        </div>

        <div class="form-group">
           	{{ Form::label('compania_id', '* Compañia de celular') }} 
			<div>
                
               	<select class="form-control" name="compania_id" data-validation="required" data-validation-error-msg="Seleccione compañia"  required>
                    
               		@if($usuario->compania_id == "")
               			<option value="">-Seleccione-</option>
               			<option value=1>MOVISTAR</option>
	                   	<option value=2>CLARO</option>
	                   	<option value=3>CNT</option>
                    @elseif($usuario->compania_id == 1)
   	                   	<option value=1 selected>MOVISTAR</option>
	                   	<option value=2>CLARO</option>
	                   	<option value=3>CNT</option>
                    @elseif($usuario->compania_id == 2)
		               	<option value=1>MOVISTAR</option>
	                   	<option value=2 selected>CLARO</option>
	                   	<option value=3>CNT</option>
                    @elseif($usuario->compania_id == 3)
		               	<option value=1>MOVISTAR</option>
	                   	<option value=2>CLARO</option>
	                   	<option value=3 selected>CNT</option>
                    @endif
                </select>
  			</div>
			{{ $errors->first('compania_id', '<p class="alert alert-danger errores">:message</p>')}}
		</div>

		 <div class="form-group">
           	{{ Form::label('whatsapp', '* ¿Usas Whatsapp?') }} 
			<div>
                
               	<select class="form-control" name="whatsapp" data-validation="required" data-validation-error-msg="Seleccione un tipo"  required>
                    
	                   <option value= 0 > NO </option>
	                   <option value= 1 > SI </option>
                       
                </select>
  			</div>
			{{ $errors->first('whatsapp', '<p class="alert alert-danger errores">:message</p>')}}
		</div>

		<div class="form-group">
			{{ Form::label('telefono', 'Teléfono convencional', ['class'=>'control-label']) }} 
			<p class="informacion-adicional">Opcional, no obligatorio</p>
			<div>
			{{ Form::text('telefono', $usuario->telefono,
				[
					'class' => 'form-control',
					'title'=>'Teléfono del anunciante',
					'placeholder'=>'Ejm: 547750',
					'id'=>'telefono_anunciante',

					'data-validation'=>"length  number custom",

					'data-validation-optional'=>"true",
								
					'data-validation-length'=>"6-9",
					'data-validation-regexp'=>"[0-9]$",

					'data-validation-error-msg-length'=>"Entre 6 a 9 digitos",
					'data-validation-error-msg-number'=>"Ingrese solo digitos",
					'data-validation-error-msg-custom'=>"Ingrese solo digitos por favor",
					
				])
			}}
				
			</div>
				{{ $errors->first('telefono', '<p class="alert alert-danger errores">:message</p>')}}
		</div>
		
		<div class="form-group">
           	{{ Form::label('tipopersona', '* Eres') }} 
			<div>
                <select class="form-control" name="tipopersona" data-validation="required" data-validation-error-msg="Seleccione un tipo" required>
                   	<option value="">- Seleccione -</option>
                   	<option value="particular">Particular</option>
                   	<option value="negocio">Empresa/negocio</option>
               	</select>
					
			</div>
			{{ $errors->first('tipopersona', '<p class="alert alert-danger errores">:message</p>')}}
		</div>
			
	
</fieldset>