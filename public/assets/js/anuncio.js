$(document).ready(function(){

    $('#delete').on('show.bs.modal', function(e) { 
    	$(this).find('.btnmoddelete').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#publish').on('show.bs.modal', function(e) { 
    	$(this).find('.btnmodpublicar').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#deactivate').on('show.bs.modal', function(e) { 
    	$(this).find('.btnmoddesactivar').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#editaranuncioactivo').on('show.bs.modal', function(e) { 
    	$(this).find('.btnmodeditaranuncioactivo').attr('href', $(e.relatedTarget).data('href'));
    });


	$('#denunciarcomentario').on('show.bs.modal', function(e) { 
    	$(this).find('.btndenunciacomentario').attr('href', $(e.relatedTarget).data('href'));
    });

	$('#denunciarrespuesta').on('show.bs.modal', function(e) { 
    	$(this).find('.btndenunciarespuesta').attr('href', $(e.relatedTarget).data('href'));
    });

	$('#borrarcomentario').on('show.bs.modal', function(e) { 
    	$(this).find('.btnmodborrarcomentario').attr('href', $(e.relatedTarget).data('href'));
    });

	$('#borrarrespuesta').on('show.bs.modal', function(e) { 
    	$(this).find('.btnmodborrarrespuesta').attr('href', $(e.relatedTarget).data('href'));
    });



	/* Carga categorias en el select de crear anuncio (Primer paso) */
	$('input[name="options"]').change(function(){ 
		seccion_id=$( 'input[name="options"]:checked' ).val();
		
			if(seccion_id==1){
				$("#opcion2").removeClass();
				$("#opcion3").removeClass();
				$("#opcion"+seccion_id).addClass("glyphicon glyphicon-ok");
			}else if(seccion_id==2){
				$("#opcion1").removeClass();
				$("#opcion3").removeClass();
				$("#opcion"+seccion_id).addClass("glyphicon glyphicon-ok");
			}else if(seccion_id==3){
				$("#opcion1").removeClass();
				$("#opcion2").removeClass();
				$("#opcion"+seccion_id).addClass("glyphicon glyphicon-ok");
			}
		
		$.ajax({
			url: 'categorias',
			type: 'POST',
			data: 'seccion2='+seccion_id, //enviamos el id
			dataType: 'json',
			success: function(categoria){
				$('select#subcategoria').html('');
				$('select#subcategoria').append($('<option></option>').text('- Subcategorias -').val(''));
				
				$('input:hidden[name=seccion_id]').val(seccion_id );
			
				$('select#categoria').html('');
				$('select#categoria').append($('<option></option>').text('-Categorias-').val('')); 
						
				$.each(categoria, function(i) {
					$('select#categoria').append("<option class='opciones_categorias' value=\""+categoria[i].id+"\">"+categoria[i].categoria+"<\/option>");
				});
			}
		})
	});
 	
 	/* Carga Subcategorías al momento de crear anuncio (Primer paso)*/
	$("#categoria").change(function(event){
		var categoria_id = $("#categoria option:selected").val(); 
		//Por medio de AJAX consultamos la ruta creada en laravel llamada subcategorias
		$.ajax({
			url: 'subcategorias',
			type: 'POST',
			data: 'categoria='+categoria_id, //enviamos el id
			dataType: 'json',
			success: function(subcategoria){
				$('select#subcategoria').html('');
				$('select#subcategoria').append($('<option></option>').text('- Subcategorías -').val('')); 

				$('select#opcion_seccion').html('');
				$('select#opcion_seccion').append($('<option></option>').text('- Pregunta -').val(''));
				//recorremos con el metodo each el objeto
				$.each(subcategoria, function(i) {
					//Con los parametros que recibimos en nuestro objeto estado creamos las opciones
					$('select#subcategoria').append("<option value=\""+subcategoria[i].id+"\">"+subcategoria[i].subcategoria+"<\/option>");
				});
			}
		})
	});

	/* Carga opciones (Preguntas) al momento de crear anuncio (Primer paso)*/
	$("#subcategoria").change(function(event) {
		
		var seccion_id=$( 'input[name="options"]:checked' ).val();

		$.ajax({
			url: 'opcion',
			type: 'POST',
			data: 'seccion='+seccion_id, //enviamos el id
			dataType: 'json',
			success: function(opcion){
				$('select#opcion_seccion').html('');
				$('select#opcion_seccion').append($('<option></option>').text('- Pregunta -').val('')); 
				
				$.each(opcion, function(i) {
					
					$('select#opcion_seccion').append("<option value=\""+opcion[i].id+"\">"+opcion[i].opcion+"<\/option>");
				});
				$('#pregunta_seccion').show();
			}
		})
	});

	/* Envia comentario de anuncio mediante ajax*/
	$("#enviarcomentario").click(function(e){
		var anuncio_id = $("#anuncio_id").val(); 
	
		ruta= anuncio_id+'/'+'comentario';
		
       	$.ajax({
			url:ruta,
			type:'POST',
			data: $("#form").serialize(),
			//dataType: 'json',
			beforeSend: function(respuesta) {
           		$("#img-cargando").show();
 				$("#enviarcomentario").hide(200);
        	},
			success: function (comentarios){
							
				document.getElementById('form').reset();

				if(comentarios.success==true){
					$("#enviarcomentario").show(200);	
					$("#img-cargando").hide();
					$("#mensaje").html('');
					$("#mensaje_estatuscomentar").html('');
					$("#mensaje").append("<p class='alert alert-success'>"+"Su comentario se publicó correctamente"+"<\/p>");
					$("#mensaje_estatuscomentar").append("<p class='bg-success text-success'>"+"Comentario publicado"+"<\/p>");

					$("#_comentario").html('');


					$('.chat').append("<li class='left clearfix'>"+"<span class='chat-img pull-left'>"
						+"<img src='"+comentarios.foto+"' class='img-circle img-comentario' \/>"
						+"<\/span>"

						+"<div class='chat-body clearfix'>"+"<div class='header'>"
							+"<strong class='primary-font'>"+comentarios.nombres+"<\/strong>"
							+"<small class='pull-right text-muted'>"
								+"<span class='glyphicon glyphicon-time'>"+"<\/span>"+comentarios.fecha
							+"<\/small>"
						+"<\/div>"	
							+"<p>"+comentarios.comentario+"<\/p>"
						+"<\/div>"
						+"<\/li>");
				}else if(comentarios.success==false){
					$("#img-cargando").hide();
					$("#enviarcomentario").show(200);
					$("#mensaje").html('');
					$("#mensaje_estatuscomentar").html('');

					$("#mensaje").append("<p class='alert alert-danger'>"+"Su comentario no fue publicado"+"<\/p>");
					
					$.each(comentarios.errors, function(index, value){
						$("#_"+index).text("Comentario no publicado. "+value);
					});
					
				}
			},
			error: function(response){
		          
		        console.log(response);
		    }
		})    
    });

	/* Muestra caja responder comentario */
	$(".respuesta").click(function(e){
		e.preventDefault();
		var estetituloes= $(this).data('title');
	
		$('.ocultisimo').hide();
		$('.cajaresponder_'+estetituloes).show();
	
		$('.respuesta').show();
		$(this).hide();

		/*Aqui termina, solo muestra lA CAJA CORRESPONDIENTE*/
	});
	
	/* Oculat caja responder comentario */
	$(".cancelarespuesta").click(function(e){
		e.preventDefault();
		
		$('.ocultisimo').hide();
		$('.respuesta').show();
	});

	/*Envia respuesta de comentario mediante ajax */
	$(".enviarrespuesta").click(function(e){
		var anuncio_id = $("#anuncio_id").val(); 
		var comentariotitulo = $(this).data('title');
		
		ruta = anuncio_id+'/'+'respuesta';
		
		$.ajax({
			url:ruta,
			type:'POST',
			data: $("#formrespuesta_"+comentariotitulo).serialize(),
			//dataType: 'json',
			beforeSend: function(respuesta) {
           		
        	},
			success: function (respuestas){
							
				document.getElementById('formrespuesta_'+comentariotitulo).reset();
				$('.ocultisimo').hide();
				$('.respuesta').show();
				$(".respuesta-enviada"+comentariotitulo).html('');
				
				if(respuestas.success==true){

					$(".respuesta-enviada"+comentariotitulo).append("<p class='bg-success text-success'>"+" Su respuesta fue publicada correctamente"+"<\/p>");
					$('.listarespuesta_'+comentariotitulo).append("<li class='left clearfix'>"
						+"<div class='cajita-respuesta'>"
							+"<span class='chat-img pull-left'>"
							+"<img src='"+respuestas.foto+"' class='img-circle img-respuesta' \/>"
							+"<\/span>"

							+"<div class='chat-respuesta clearfix'>"
								+"<div class='header'>"
									+"<strong class='fuente-nombrecomentario'>"+respuestas.nombres+"<\/strong>"
									+"<small class='pull-right text-muted'>"
									+"<span class='glyphicon glyphicon-time'>"+"<\/span>"+respuestas.fecha
									+"<\/small>"
								+"<\/div>"	
								+"<p>"+respuestas.respuesta+"<\/p>"
							+"<\/div>"
						+"<\/div>"
						+"<\/li>");

				}else if(respuestas.success==false){
					
					$.each(respuestas.errors, function(index, value){

						$(".respuesta-enviada"+comentariotitulo).append("<p class='bg-danger text-danger'>"+" Respuesta no publicada, ingresar mínimo 10 caracteres"+"<\/p>");
					});
				}
			},
			error: function(response){
		        console.log(response);
		    }
		})    
	});

	
	/* Muestra caja para responder mensaje */
	$("#btn-mostrarespondermensaje").click(function(e){
		e.preventDefault();

		$('.panel-respondermensaje').show();
		$('#btn-mostrarespondermensaje').hide();
		$('#btn-eliminarmensaje').hide();
	});

	/* Oculta caja para responder mensaje */
	$("#btncancelarrespondermensaje").click(function(e){
		e.preventDefault();
		
		$('.panel-respondermensaje').hide();
		$('#btn-mostrarespondermensaje').show();
		$('#btn-eliminarmensaje').show();
	});

	/* Efecto de loading a botón enviarcorreo automatizado */
	$(".btn-enviarcorreoautomatizado").click(function() {
    	var $btn = $(this);
        $btn.button('loading');
        // simulating a timeout
        setTimeout(function () {
            $btn.button('reset');
        }, 40000);
    });
});        