<div class="form-group">
	{{ Form::label('fotos','Foto') }}
		<p class="informacion-adicional">Subir foto con formato .jpg .jpeg o .png. Que su tamaño no supere los 3 MB.</p>
		<input id="foto1" name="foto1" type="file" class="file" data-show-preview="false" data-validation="mime size" data-validation-allowing="jpg, png" data-validation-max-size="3000kb" data-validation-error-msg-mime="Solo imágenes formato .jpg o .png" data-validation-error-msg="La foto es demasiado pesada (Máximo 3 MB)">
		
			{{ $errors->first('foto1', '<p class="alert alert-danger errores">:message </p>') }} 
</div>
