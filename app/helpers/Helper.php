<?php

class Helper
{
    public static  function nombre_simple($nombreCompleto)
    {
        $nombreSimple= "";
        #convertir en un arreglo la cadena
        # ucwords convierte el primer caracter de cada palabra a mayuscula
        # strtolower convierte cadena a minusculas
        # trim borra espacios al final y al principio de la cadena
        $nombres = ucwords(strtolower( trim($nombreCompleto)));
        
        $nombresApellidos = explode(" ", $nombres);

        #tamaño del arreglo para calcular el número de nombres y apellidos ingresados
        $cantidadDePalabras= sizeof($nombresApellidos);


        if($cantidadDePalabras == 1){
            $nombreSimple = $nombresApellidos[0]; 
        }else if($cantidadDePalabras == 2){
            #se devuelve el primer nombre y la inicial del primer apellido
            $nombreSimple = $nombresApellidos[0]." ".substr($nombresApellidos[1], 0,1); 
        }else if ($cantidadDePalabras == 3){
            /*al no conocer exactamente cual es el apellido o segundo nombre, se devuelve 
            * primer nombre y la inicial del segundo argumento
            */
            $nombreSimple = $nombresApellidos[0]." ".substr($nombresApellidos[1], 0,1);  
        }else if ($cantidadDePalabras == 4){
            #se devuelve el primer nombre e inicial del primer apellido;
            $nombreSimple = $nombresApellidos[0]." ".substr($nombresApellidos[2], 0,1); 
        }
 
        return $nombreSimple;
    } 

    public static function compararCadenas($cadenaBase, $cadenaComparada)
    {
        if(strcmp ($cadenaBase, $cadenaComparada) == 0)
        {
            return true;
        }
        return false;
    }

    public static function purificarCadena($cadena){
         return \Purifier::clean($cadena);
    }
}