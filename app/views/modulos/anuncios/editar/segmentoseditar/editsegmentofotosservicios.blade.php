{{ Form::label('fotos','Foto actual') }}

<div class="form-group fotoedicion">
	@if($anuncio->foto1=="")
	<p class="informacion-adicional">Subir foto con formato .jpg .jpeg o .png. Que su tamaño no supere los 4 MB.</p>
	 	<div class="fotos-edicion">
			<span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
			
			
		</div>
		<small>Sin foto, presiona Foto principal y sube una.</small>
	 	
	@else

			<p class="informacion-adicional">Subir foto con formato .jpg .jpeg o .png. Que su tamaño no supere los 4 MB.</p>

	<div>
		<img class="fotos-edicion" src="{{ asset($anuncio->foto1) }}" alt="">
	</div>
		
		<small>Si deseas cambiar foto, presiona Foto y sube una nueva</small>
	@endif
	
	<input id="foto1" name="foto1" type="file" class="file" data-show-preview="false" data-validation="mime size" data-validation-allowing="jpg, png" data-validation-max-size="4M" data-validation-error-msg-mime="Solo imágenes formato .jpg o .png" data-validation-error-msg="La foto es demasiado pesada (Máximo 4 MB)">
	{{ $errors->first('foto1', '<p class="alert alert-danger errores">:message </p>') }} 
</div>


			
