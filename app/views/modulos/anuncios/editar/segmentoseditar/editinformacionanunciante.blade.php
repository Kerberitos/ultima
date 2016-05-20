<fieldset>
 	<legend>Información del anunciante</legend>
 		<div class="form-group">
			{{ Form::label('anunciante','* Nombres del Anunciante') }}
			<p class="informacion-adicional">¿Por quién preguntar al llamar?</p>
			<div>
				{{ Form::text('anunciante',$anunciante->anunciante,
						[
							'class' => 'form-control',
							'title'=>'Nombre del anunciante',
							'placeholder' => 'Ejm: Edro Leal', 
							'required' => 'required',

							'pattern'=>"^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]{1,30}$",

							'data-validation'=>"required custom length",


							'data-validation-regexp'=>"^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]{1,30}$",
							'data-validation-length'=>"8-30",
									

							'data-validation-error-msg-required'=>"Ingrese nombre del anunciante",

							'data-validation-error-msg-custom'=>"Por favor solo letras",
							'data-validation-error-msg-length'=>"Mínimo 8 y máximo 30 caracteres",

						])
				}}
				
			</div>
			
			{{ $errors->first('anunciante', '<p class="alert alert-danger errores">:message </p>') }}
		</div>

		<div class="form-group">
			{{ Form::label('celular', '*Celular') }}      
       		<div>
				{{ Form::text('celular', $anunciante->celular,
						[
							'class' => 'form-control',
							'title'=>'Debe introducir su celular',
							'id'=>'celular',

							'data-validation'=>"required custom",

							'data-validation-regexp'=>"^0[0-9]{9}$",
							

							'data-validation-error-msg-required'=>"Ingrese un número de celular",
							'data-validation-error-msg-custom'=>"Debe iniciar con 0, solo 10 dígitos",
						])
				}}
				
			</div>
			
				{{ $errors->first('celular', '<p class="alert alert-danger errores">:message</p>')}}
        </div>


         <div class="form-group">
           	{{ Form::label('compania_id', '* Compañia de celular') }} 
			<div>
                
               	<select class="form-control" name="compania_id" data-validation="required" data-validation-error-msg="Seleccione compañia"  required>
                    @if($anunciante->compania_id==1)
		               	
	                   	<option value=1 selected>MOVISTAR</option>
	                   	<option value=2>CLARO</option>
	                   	<option value=3>CNT</option>
                    @elseif($anunciante->compania_id==2)
		               	
	                   	<option value=1>MOVISTAR</option>
	                   	<option value=2 selected>CLARO</option>
	                   	<option value=3>CNT</option>
                    @elseif($anunciante->compania_id==3)
		               	
	                   	<option value=1>MOVISTAR</option>
	                   	<option value=2>CLARO</option>
	                   	<option value=3  selected>CNT</option>
                    @endif
                       
                </select>
  			</div>
			{{ $errors->first('compania_id', '<p class="alert alert-danger errores">:message</p>')}}
		</div>


		 <div class="form-group">
           	{{ Form::label('whatsapp', '* Usas Whatsapp') }} 
			<div>
                
               	<select class="form-control" name="whatsapp" data-validation="required" data-validation-error-msg="Seleccione un tipo"  required>
                    
                        @if($anunciante->whatsapp==0)
		               	
	                   		<option value= 0 selected> NO </option>
	                   		<option value= 1 > SI </option>
                    	@elseif($anunciante->whatsapp==1)
		               	
		                   	<option value= 0 > NO </option>
	                   		<option value= 1 selected> SI </option>
                    	@endif
                </select>
  			</div>
			{{ $errors->first('whatsapp', '<p class="alert alert-danger errores">:message</p>')}}
		</div>

		<div class="form-group">
			{{ Form::label('telefono', 'Teléfono convencional') }} 
				<div>
					{{ Form::text('telefono', $anunciante->telefono,
							[
								'class' => 'form-control',
								'title'=>'Teléfono del anunciante',
								
								'id'=>'telefono_anunciante',

								'data-validation'=>"custom",
								'data-validation-regexp'=>"[0-9]$",

								'data-validation-optional'=>"true",


								'data-validation-error-msg-custom'=>"Ingrese solo digitos por favor",



							])
					}}
					
				</div>
				
				{{ $errors->first('telefono', '<p class="alert alert-danger errores">:message</p>')}}
		 </div>


		




		<div class="form-group">
           	{{ Form::label('tipopersona', '* Eres') }} 
				<div>
                     <select class="form-control" name="tipopersona" data-validation="required" data-validation-error-msg="Seleccione un tipo"  required>
                     	@if($anunciante->tipopersona=="negocio")
	                       	<option value="particular">Particular</option>
	                       	<option value="negocio" selected>Empresa/negocio</option>
                     	@elseif($anunciante->tipopersona=="particular")
		                       	<option value="particular" selected>Particular</option>
		                       	<option value="negocio">Empresa/negocio</option>
                     	@endif
                       
                   	</select>
					
				</div>
					{{ $errors->first('tipopersona', '<p class="alert alert-danger errores">:message</p>')}}
		</div>
		
		
</fieldset>