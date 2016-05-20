<?php namespace imagenes;

/**
 * ----------------------------------------------------
 * Clase que: 
 *      - Manipula las imagenes de anuncios
 *      
 * ----------------------------------------------------
 * Rutas:
 *
 *      - No utiliza rutas, los métodos son invocados con una instancia de la clase
 *      
 * ----------------------------------------------------
 * autor: Edison Alexander Rojas León
 * email: 
 * fecha: 00/00/0000
 *
 */

class ImagenController extends \BaseController
{
	
    /* Sube fotos de anuncios al servidor*/
    public function subirfotos($carpetaanuncio, $fotosubida, $numfoto)
    {
        // ruta del directorio pincipal donde se guardarán las fotos subidas por usuarios sobre sus anuncios
        # $directorio=public_path().'/uploads/';
        // Si no existe el directorio donde se guardarán las fotos, se crea con los corresondientes permisos
        if(! is_dir($carpetaanuncio))
        {
            mkdir($carpetaanuncio, 0777, true);
        }

        /*Asignar el nombre de la foto*/
        if ($numfoto == 1)
        {
            $nombrefoto='mir_foto1';
        }
        else if ($numfoto == 2)
        {
            $nombrefoto = 'mir_foto2';
        }
        else if ($numfoto == 3)
        {
            $nombrefoto = 'mir_foto3';
        }
        else if ($numfoto == 4)
        {
            $nombrefoto = 'mir_foto4';
        }
        
        // asignar al nombrefinal que se gardará en bd la respectiva extension (jpg, jpeg, png)*/
        $nombreFinal = $nombrefoto.'.'.$fotosubida->getClientOriginalExtension();

        // nombre para la copia de foto1 que servirá como miniatura
        $miniatura = 'miniaturita'.'.'.$fotosubida->getClientOriginalExtension();

        $fotosubida->move($carpetaanuncio, $nombreFinal);
        
        // realizar copia solo de foto1 para converirla en miniatura
        if ($numfoto == 1)
        {
            copy ($carpetaanuncio.$nombreFinal, $carpetaanuncio.$miniatura);
        }

        $intImagen = \Image::make($carpetaanuncio.$nombreFinal)->resize(750, 750);
                
        $intImagen->save($carpetaanuncio.$nombreFinal);
    }

    /* Redimensiona imagen */
    public function resizeImagen($ruta, $nombre, $alto, $ancho, $nombreN, $extension)
    {
   		$rutaImagenOriginal = $ruta.$nombre;
    
    	if ($extension == 'GIF' || $extension == 'gif')
        {
    		$img_original = imagecreatefromgif($rutaImagenOriginal);
    	}
    	
        if ($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG')
        {
    		$img_original = imagecreatefromjpeg($rutaImagenOriginal);
    	}
    	
        if ($extension == 'png' || $extension == 'PNG')
        {
    		$img_original = imagecreatefrompng($rutaImagenOriginal);
    	}

    	$max_ancho = $ancho;
    	$max_alto = $alto;
    	list($ancho,$alto)=getimagesize($rutaImagenOriginal);
    	$x_ratio = $max_ancho / $ancho;
    	$y_ratio = $max_alto / $alto;
    	
        if ( ($ancho <= $max_ancho) && ($alto <= $max_alto) )
        { 
  			$ancho_final = $ancho;
			$alto_final = $alto;
		}
        else if (($x_ratio * $alto) < $max_alto)
        {
			$alto_final = ceil($x_ratio * $alto);
			$ancho_final = $max_ancho;
		}
        else
        {
			$ancho_final = ceil($y_ratio * $ancho);
			$alto_final = $max_alto;
		}
    	
        $tmp = imagecreatetruecolor($ancho_final,$alto_final);
    		
    	$black = imagecolorallocate($tmp, 255, 255, 255);
    	// Make the background transparent
		//imagecolortransparent($tmp, $black);
		imagefill($tmp, 0, 0, $black);

    	imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final,$ancho,$alto);
    		
    	if ($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG')
        {
    		$calidad=70;
    		imagejpeg($tmp,$ruta.$nombreN,$calidad);
    	}
        else if ($extension == 'png' || $extension == 'PNG')
        {
    		imagepng($tmp,$ruta.$nombreN);
    	}
    	
        imagedestroy($img_original);
    }

}