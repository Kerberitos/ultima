<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Activa tu cuenta en miradita</title>
    <style type="text/css">
  	 a:link{   
   		 text-decoration:none;   
  	   }  
    	.clasesita{
    		border: 1px solid #0101DF;
    		border-radius: 1px;
    		color: white;
    		background-color: #308BCD;
    		padding: 10px 13px;
    		text-decoration: none !important;
    	}
    	.centrar{
    		text-align:center;
    		margin-top:20px;
    		margin-bottom: 25px;
    	}
    </style>
    
  </head>
  <body>
	<h3><b>Activar cuenta en Miradita Loja</b></h3>
  <p class="centrar"></p>
	<p> Bienvenido a Miradita Loja, Miradita es una  comunidad nacida bajo el objetivo de brindar a la ciudadanía lojana un espacio en Internet, dónde se podrá crear, publicar y buscar anuncios de forma gratuita.</p>

	<div class="centrar">Se ha registrado correctamente ahora solo debe confirmar su correo electrónico para activar su cuenta en Miradita Loja, para ello haga clic en el siguiente enlace:</div>
	<p class="centrar"></p>
	<p class="centrar"> {{ link_to('activar/'.$random, 'ACTIVAR CUENTA', array('class' => 'clasesita'), null) }} </p>   
	
	
    
    
    
    
  </body>
</html>
