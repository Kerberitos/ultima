$(document).ready(function(){
	
	//alert($('input:hidden[name=actualfoto]').val());
	//alert('llamadno al script ahora');
	
	$("#fotoperfil").fileinput({
			browseClass: "btn btn-primary btn-block",
			removeClass: "btn btn-danger btn-block",
			browseLabel: "Buscar foto",
			showCaption: false,
			showRemove: false,
			showUpload: false,
			previewFileType: "image",
    		allowedFileExtensions: ["jpg", "png", "jpeg"],
    		previewClass: "bg-warning",
    		browseIcon: '<i class="glyphicon glyphicon-picture"></i> ',

    		initialPreview: [
    			"<img src=\'/assets/images/"+"u"+"suario.png\'"+"class=\'file-preview-image\'"+">"

        			/*"<img src='/assets/images/user.jpg' class='file-preview-image' alt='Foto de perfil' title='Foto de perfil'>",*/
 	],
    			overwriteInitial: true,
    			initialCaption: "Foto de perfil"
    		
    			/*initialPreview: [
        			"<img src='/assets/images/user.jpg' class='file-preview-image' alt='Foto de perfil' title='Foto de perfil'>",
    			],
    			overwriteInitial: true,
    			initialCaption: "The Moon and the Earth"*/
	});
	$(function() {
		var inputFoto=$('input:hidden[name=actualfoto]').val();
		if(inputFoto!=""){
			//var inputFoto="/assets/images/"+"u"+"ser.jpg";
			$('.file-preview-image').removeAttr("src");
			$('.file-preview-image').attr( "src", inputFoto);
		}
	});
});