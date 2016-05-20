
$("#foto1").fileinput({
	
	browseLabel: "Foto principal",
	removeLabel: "",
	browseIcon: '<i class="glyphicon glyphicon-camera"></i> ',
	showCaption: true,
	showRemove: true,
	showUpload: false,
	previewFileType: "image",
    allowedFileExtensions: ["jpg", "png", "jpeg"],
});
$(".file").fileinput({
	
	browseLabel: "Foto",
	removeLabel: "",
	browseIcon: '<i class="glyphicon glyphicon-picture"></i> ',
	showCaption: true,
	showRemove: true,
	showUpload: false,
	previewFileType: "image",
    allowedFileExtensions: ["jpg", "png", "jpeg"],
});

/*$("#fotoperfil").fileinput({
	
	browseLabel: "Foto",
	removeLabel: "",
	browseIcon: '<i class="glyphicon glyphicon-picture"></i> ',
	showCaption: true,
	showRemove: false,
	showUpload: false,
	previewFileType: "image",
    allowedFileExtensions: ["jpg", "png", "jpeg"],
});*/