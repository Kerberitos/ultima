<div class="form-group">
	{{ Form::label('fotos','Fotos') }}
	<p class="informacion-adicional">Subir fotos con formato .jpg o .png. Que su tamaño no supere los 3 MB.</p>
	<input id="foto1" name="foto1" type="file" class="file" data-show-preview="true" data-validation="size mime" data-validation-allowing="jpg, png" data-validation-max-size="3000kb" data-validation-error-msg-size="La foto principal es demasiado pesada (Máximo 3 MB)" data-validation-error-msg-mime="Solo imágenes formato .jpg o .png" >
			{{ $errors->first('foto1', '<p class="alert alert-danger errores">:message </p>') }} 
</div>

<div class="form-group">
	<input id="foto2" name="foto2" type="file" class="file" data-show-preview="false" data-validation="mime size" data-validation-allowing="jpg, png" data-validation-max-size="3000kb" data-validation-error-msg-size="La foto es demasiado pesada (Máximo 3 MB)" data-validation-error-msg-mime="Solo imágenes formato .jpg o .png" >
		{{ $errors->first('foto2', '<p class="alert alert-danger errores">:message </p>') }} 
</div>
			
<div class="form-group">
	<input id="foto3" name="foto3" type="file" class="file" data-show-preview="false" data-validation="mime size" data-validation-allowing="jpg, png" data-validation-max-size="3000kb" data-validation-error-msg-size="La foto es demasiado pesada (Máximo 3 MB)" data-validation-error-msg-mime="Solo imágenes formato .jpg o .png" >
		{{ $errors->first('foto3', '<p class="alert alert-danger errores">:message </p>') }}  
	</div>
							
<div class="form-group">
	<input id="foto4" name="foto4" type="file" class="file" data-show-preview="false" data-validation="mime size" data-validation-allowing="jpg, png" data-validation-max-size="3000kb" data-validation-error-msg-size="La foto es demasiado pesada (Máximo 3 MB)" data-validation-error-msg-mime="Solo imágenes formato .jpg o .png" >
		{{ $errors->first('foto4', '<p class="alert alert-danger errores">:message </p>') }} 
</div>