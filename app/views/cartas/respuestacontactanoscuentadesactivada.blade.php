<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Información sobre cuenta en Miradita Loja</title>
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
	<h3><b>Su cuenta se encuentra {{$estado}}</b></h3>

	<div>
    <p>
    {{$motivo}} 
  </p>
    
    <p class="centrar"> {{ link_to('solicitar/enlace-de-activacion', 'Solicitar nuevo enlace', array('class' => 'clasesita'), null) }} </p>   
    </div>
	  
  </body>
</html>
