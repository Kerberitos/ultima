<!DOCTYPE html>
<html lang="es">
  <head>
   
    <title>Reactiva tu cuenta que fue borrada</title>
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
  <h3><b>Reactive su cuenta en Miradita Loja</b></h3>

  
  <div class="centrar"> Hemos recibido una petición para reactivar su cuenta en Miradita Loja. </div>
  <p class="centrar"> Si realizó esta petición, haga clic en el enlace de abajo. Si no realizó esta petición, puede ignorar este correo. </p>
  
  <p class="centrar"> {{ link_to('reactivar/nuevopassword/'.$id_usuario.'/'.$random, 'REACTIVAR CUENTA', array('class' => 'clasesita'), null) }} </p>  
  
  
    
    
    
    
  </body>
</html>
