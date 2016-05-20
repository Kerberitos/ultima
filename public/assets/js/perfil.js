$(document).ready(function(){


	
	//Valores por Defecto
	$("#menu-perfil li:first").addClass("active");
	
	$("#contenido-perfil .tab").hide();
	$("#contenido-perfil .tab:first").show();

	//Cuando haga click en un elemento del menu
	$("#menu-perfil li").click(function(e){
			e.preventDefault();
				//Quitar clases active
				$("#menu-perfil li").removeClass('active');
				//Agrego clase active al elemento seleccionado
				$(this).addClass("active");

				//Obtengo indice del elemento seleccionado
				var menuIndice = $(this).index() + 1;
				
				//Oculto los tabs visibles
				$("#contenido-perfil .tab").hide();
				
                //Con un each recorro todos los tabs dentro del contenido-perfil
				$("#contenido-perfil .tab").each(function(){
					//Obtengo el indice del tab actual
					var tab = $(this).index() + 1;

					/* Compruebo que el indice del item del menu seleccionado					
					*  Sea Igual al del tab actual
					*/
					if(tab==menuIndice){	
						//Muestro el tab					
						$(this).show();
					}
				});				
			});
});