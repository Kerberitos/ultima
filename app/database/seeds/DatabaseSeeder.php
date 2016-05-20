<?php

use Anuncia\Entidades;

class DatabaseSeeder extends Seeder {

	
	public function run()
	{
		Eloquent::unguard();
		// $this->call('UserTableSeeder');
		DB::table('roles')->insert(array('rol'=>'usuario'));
		DB::table('roles')->insert(array('rol'=>'administrador'));
		DB::table('roles')->insert(array('rol'=>'super'));
		$this->command->info('Roles sembrados en la tabla roles');
		
		DB::table('estados')->insert(array('estado'=>'activado'));
		DB::table('estados')->insert(array('estado'=>'desactivado'));
		DB::table('estados')->insert(array('estado'=>'bloqueado'));
		DB::table('estados')->insert(array('estado'=>'eliminado'));
		DB::table('estados')->insert(array('estado'=>'revision'));
		DB::table('estados')->insert(array('estado'=>'denunciado'));
		DB::table('estados')->insert(array('estado'=>'rechazado'));
		$this->command->info('Estados sembrados en la tabla estados');
		
		DB::table('companias')->insert(array('nombre'=>'MOVISTAR'));
		DB::table('companias')->insert(array('nombre'=>'CLARO'));
		DB::table('companias')->insert(array('nombre'=>'CNT'));
		$this->command->info('colores sembrados en la tabla companias');
		
		DB::table('secciones')->insert(array('seccion'=>'Clasificados'));
		DB::table('secciones')->insert(array('seccion'=>'Servicios'));
		DB::table('secciones')->insert(array('seccion'=>'Empleos'));
		$this->command->info('secciones sembradas en la tabla secciones ok');
		
		DB::table('preguntas')->insert(array('seccion_id'=>'1','opcion'=>'Yo vendo'));
		DB::table('preguntas')->insert(array('seccion_id'=>'1','opcion'=>'Yo alquilo'));
		DB::table('preguntas')->insert(array('seccion_id'=>'1','opcion'=>'Quiero comprar'));
		DB::table('preguntas')->insert(array('seccion_id'=>'1','opcion'=>'Busco alquiler'));
		DB::table('preguntas')->insert(array('seccion_id'=>'1','opcion'=>'Intercambio'));
		
		DB::table('preguntas')->insert(array('seccion_id'=>'2','opcion'=>'Ofrezco servicio'));
		
		DB::table('preguntas')->insert(array('seccion_id'=>'3','opcion'=>'Necesito trabajo'));
		DB::table('preguntas')->insert(array('seccion_id'=>'3','opcion'=>'Ofrezco trabajo'));
		DB::table('preguntas')->insert(array('seccion_id'=>'3','opcion'=>'Pasantías'));
		$this->command->info('Opciones sembradas en la tabla preguntas. ok');
		
		
		
		
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Informática','icono'=>'icon-laptop'));
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Celulares y telefonía','icono'=>'icon-iphone'));
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Propiedad, negocio e inmobiliaria','icono'=>'icon-office'));
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Autos, motos y motorizados','icono'=>'icon-automobile'));
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Muebles y todo para el hogar','icono'=>'icon-home-2'));
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Para locales y oficina','icono'=>'icon-cabinet-2'));
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Imágen, Tv y video','icono'=>'icon-hdtv'));
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Audio, sonido e instrumentos musicales','icono'=>'icon-music'));
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Arte, libros y cultura','icono'=>'icon-brush'));
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Vestimenta, calzado y belleza','icono'=>'icon-tshirt'));
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Deporte, actividad física y juguetes','icono'=>'icon-soccer'));
		DB::table('categorias')->insert(array('seccion_id'=>'1','categoria'=>'Mascotas y animales','icono'=>'icon-paw'));
		
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Reparación, instalación y mantenimiento','icono'=>'icon-screwdriver'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Reformas y construcción casas u oficinas','icono'=>'icon-paint-format'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Mudanza, transporte, hoteleria, turismo y mantenimiento','icono'=>'icon-truck'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Restaurante y pastelería','icono'=>' icon-chef'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Para vehículos y motos','icono'=>'icon-wrench-2'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Diversión, deporte y cultura','icono'=>'icon-drink'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Servicios médicos','icono'=>'icon-aid'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Imágen, papel, publicidad y video','icono'=>'icon-pictures'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Servicios profesionales','icono'=>'icon-user-2'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Servicios de enseñanza y cursos','icono'=>'icon-book'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Oficios varios','icono'=>'icon-scissors'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Fiestas, eventos y espectáculos','icono'=>'icon-microphone'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Belleza y cuidado personal','icono'=>'icon-eye'));
		DB::table('categorias')->insert(array('seccion_id'=>'2','categoria'=>'Otros servicios','icono'=>'glyphicon glyphicon-th-large'));
		
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Ventas y comercio','icono'=>'icon-cart'));
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Medicina y salud','icono'=>'icon-user-md'));
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Técnicos, reparación y mantenimiento','icono'=>'icon-settings'));
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Oficios y otros','icono'=>'glyphicon glyphicon-th-large'));
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Educación, docencia e investigación','icono'=>'icon-lab'));
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Profesionales','icono'=>'icon-user-3'));
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Hotelería y restaurantes','icono'=>'glyphicon glyphicon-cutlery'));
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Vehículos, transporte y turismo','icono'=>' icon-bus'));
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Diseño, publicidad y marketing','icono'=>'icon-pencil-2'));
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Administración u oficina','icono'=>'icon-paperclip'));
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Construcción y reformas en casas u oficinas','icono'=>'icon-hammer'));
		DB::table('categorias')->insert(array('seccion_id'=>'3','categoria'=>'Pasantías','icono'=>' icon-board-2'));
		
		$this->command->info('categorias sembradas en la tabla categorias ok');
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'1','subcategoria'=>'Portátil y Netbook'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'1','subcategoria'=>'Tablet'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'1','subcategoria'=>'Monitor y Pantalla'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'1','subcategoria'=>'Periférico y accesorio'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'1','subcategoria'=>'Redes'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'1','subcategoria'=>'Software'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'1','subcategoria'=>'Componente interno de PC'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'1','subcategoria'=>'Mueble para PC'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'1','subcategoria'=>'Suministro informático'));
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'2','subcategoria'=>'Celular'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'2','subcategoria'=>'Accesorio para celular'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'2','subcategoria'=>'Teléfono fijo'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'2','subcategoria'=>'Teléfono inalámbrico'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'2','subcategoria'=>'Línea telefónica'));
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'3','subcategoria'=>'Casa'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'3','subcategoria'=>'Departamento o Suite'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'3','subcategoria'=>'Garaje'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'3','subcategoria'=>'Oficina, local y bodega'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'3','subcategoria'=>'Cuarto'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'3','subcategoria'=>'Hacienda y finca'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'3','subcategoria'=>'Hotel y hostales'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'3','subcategoria'=>'Lote-Terreno'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'3','subcategoria'=>'Negocio'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'3','subcategoria'=>'Consultorio'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'3','subcategoria'=>'Otros inmuebles'));
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'4','subcategoria'=>'Auto'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'4','subcategoria'=>'Moto'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'4','subcategoria'=>'Camión'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'4','subcategoria'=>'Buseta y bus'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'4','subcategoria'=>'Camioneta'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'4','subcategoria'=>'Maquinaria y pesado'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'4','subcategoria'=>'Repuesto'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'4','subcategoria'=>'Accesorios autos y motos'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'4','subcategoria'=>'Baldes y carrocerias'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'4','subcategoria'=>'Otros'));
				
		DB::table('subcategorias')->insert(array('categoria_id'=>'5','subcategoria'=>'Accesorios y decoración'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'5','subcategoria'=>'Electrodoméstico'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'5','subcategoria'=>'Iluminación'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'5','subcategoria'=>'Muebles para casa'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'5','subcategoria'=>'Productos y utensilios de cocina'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'5','subcategoria'=>'Limpieza'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'5','subcategoria'=>'Otros'));
		
			
		DB::table('subcategorias')->insert(array('categoria_id'=>'6','subcategoria'=>'Accesorios y decoración'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'6','subcategoria'=>'Vitrina'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'6','subcategoria'=>'Frigorífico y congelador'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'6','subcategoria'=>'Estante y archivador'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'6','subcategoria'=>'Horno'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'6','subcategoria'=>'Mueble para oficina'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'6','subcategoria'=>'Suministro y material de oficina'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'6','subcategoria'=>'Fotocopiadora'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'6','subcategoria'=>'Vidrio y espejo'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'6','subcategoria'=>'Otros'));
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'7','subcategoria'=>'Televisor'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'7','subcategoria'=>'Reproductor de video'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'7','subcategoria'=>'Video Camara'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'7','subcategoria'=>'Cámara fotográfica'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'7','subcategoria'=>'Antena y decodificador'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'7','subcategoria'=>'Proyector'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'7','subcategoria'=>'Consola y video juego'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'7','subcategoria'=>'Accesorios de imagen, tv y video'));
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'8','subcategoria'=>'Equipos profesionales y Djs'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'8','subcategoria'=>'Reproductor mp3 y mp4'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'8','subcategoria'=>'Auricular'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'8','subcategoria'=>'Parlante'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'8','subcategoria'=>'Instrumento de viento'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'8','subcategoria'=>'Instrumento de cuerda'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'8','subcategoria'=>'Instrumento de percusión'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'8','subcategoria'=>'Instrumento eléctrico'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'8','subcategoria'=>'Grabadora y equipo de sonido'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'8','subcategoria'=>'Micrófono, cable y accesorio'));
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'9','subcategoria'=>'Libro'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'9','subcategoria'=>'Artesanía y antiguedad'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'9','subcategoria'=>'Manualidad'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'9','subcategoria'=>'Pintura-cuadros'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'9','subcategoria'=>'Cds musicales y películas'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'9','subcategoria'=>'Sinfónica de Loja'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'9','subcategoria'=>'Jueves Cultural'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'9','subcategoria'=>'Cine y teatro lojano'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'9','subcategoria'=>'Otras presentaciones y actos culturales'));

		
		DB::table('subcategorias')->insert(array('categoria_id'=>'10','subcategoria'=>'Zapatos'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'10','subcategoria'=>'Bolso y maleta'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'10','subcategoria'=>'Reloj y joyas'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'10','subcategoria'=>'Belleza y cuidado personal'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'10','subcategoria'=>'Accesorio y otros'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'10','subcategoria'=>'Ropa casual'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'10','subcategoria'=>'Ropa formal'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'10','subcategoria'=>'Ropa deportiva'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'10','subcategoria'=>'Gorros y gorras'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'10','subcategoria'=>'Otros'));
		
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'11','subcategoria'=>'Artículos para fútbol'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'11','subcategoria'=>'Artículos para basquet'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'11','subcategoria'=>'Artículos para natación'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'11','subcategoria'=>'Artículos para ciclismo'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'11','subcategoria'=>'Artículos para atletismo'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'11','subcategoria'=>'Patinetas y patinaje'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'11','subcategoria'=>'Máquina para ejercicios e implementos'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'11','subcategoria'=>'Juguetes en general'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'11','subcategoria'=>'Otros artículos y accesorios'));
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'12','subcategoria'=>'Perro'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'12','subcategoria'=>'Gato'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'12','subcategoria'=>'Ave'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'12','subcategoria'=>'Pez'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'12','subcategoria'=>'Caballo'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'12','subcategoria'=>'Vaca o toro'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'12','subcategoria'=>'Conejo y hamster'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'12','subcategoria'=>'Otros animales'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'12','subcategoria'=>'Accesorios para mascotas'));
		
		$this->command->info('subcategorias sembradas en la tabla sub categorias perteneciente a clasificados');
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'13','subcategoria'=>'Celulares y telefonía'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'13','subcategoria'=>'Cámaras'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'13','subcategoria'=>'TV, Video, audio y sonido'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'13','subcategoria'=>'Electrodomésticos'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'13','subcategoria'=>'Computadoras y tablets'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'13','subcategoria'=>'Instrumentos musicales'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'13','subcategoria'=>'Servicio de internet, redes'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'13','subcategoria'=>'Otros'));
		
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'14','subcategoria'=>'Albañilería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'14','subcategoria'=>'Carpintería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'14','subcategoria'=>'Cerrajería, electricidad y gas'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'14','subcategoria'=>'Jardinería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'14','subcategoria'=>'Pintura'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'14','subcategoria'=>'Plomería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'14','subcategoria'=>'Tapicería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'14','subcategoria'=>'Techos y pisos'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'14','subcategoria'=>'Vidrios'));
		

		DB::table('subcategorias')->insert(array('categoria_id'=>'15','subcategoria'=>'Chofer profesional'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'15','subcategoria'=>'Alquiler de vehículos'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'15','subcategoria'=>'Taxis'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'15','subcategoria'=>'Mudanza y fletes'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'15','subcategoria'=>'Contratación de buses y busetas'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'15','subcategoria'=>'Hospedaje'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'15','subcategoria'=>'Turismo'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'15','subcategoria'=>'Envio de paquetes y mensajería'));
		
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'16','subcategoria'=>'Restaurante'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'16','subcategoria'=>'Pizzería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'16','subcategoria'=>'Café'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'16','subcategoria'=>'Burguer y papas'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'16','subcategoria'=>'Panadería y pastelería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'16','subcategoria'=>'Otros'));
		
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'17','subcategoria'=>'Talleres'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'17','subcategoria'=>'Lavado, lubricado y limpieza'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'17','subcategoria'=>'Pintura y latería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'17','subcategoria'=>'Tapizado'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'17','subcategoria'=>'Tooning'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'17','subcategoria'=>'Sistema eléctrico y audio'));
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'18','subcategoria'=>'Bar'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'18','subcategoria'=>'Discoteca'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'18','subcategoria'=>'Gimnasio'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'18','subcategoria'=>'Complejo deportivo'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'18','subcategoria'=>'Piscina'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'18','subcategoria'=>'Biblioteca'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'18','subcategoria'=>'Cine y teatro'));
				
		DB::table('subcategorias')->insert(array('categoria_id'=>'19','subcategoria'=>'Psicología y psiquiatría'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'19','subcategoria'=>'Farmacia'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'19','subcategoria'=>'Centros de rehabilitación'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'19','subcategoria'=>'Enfermería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'19','subcategoria'=>'Ópticas'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'19','subcategoria'=>'Laboratorios y radiografía'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'19','subcategoria'=>'Clínicas y hospitales'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'19','subcategoria'=>'Odontología'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'19','subcategoria'=>'General'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'19','subcategoria'=>'Medicina natural'));
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'20','subcategoria'=>'Fotografía y filmación'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'20','subcategoria'=>'Diseño gráfico y publicidad'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'20','subcategoria'=>'Imprenta y copias'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'20','subcategoria'=>'Papelería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'20','subcategoria'=>'Librería'));
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Administración'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Auditorias'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Arquitectura y construcción'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Comunicación'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Asesoría y colsultoría'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Contabilidad'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Derecho-abogacía'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Economía'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Diseño de interiores'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Diseño y desarrollo de sitios web'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Ingeniería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Investigación'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Interpretes-traductores'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'21','subcategoria'=>'Veterinaria'));
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'22','subcategoria'=>'Música y canto'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'22','subcategoria'=>'Teatro'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'22','subcategoria'=>'Danza y baile'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'22','subcategoria'=>'Centro de enseñanza y capacitación'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'22','subcategoria'=>'Cursos de capacitación'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'22','subcategoria'=>'Clases particulares'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'22','subcategoria'=>'Idiomas'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'22','subcategoria'=>'Informática y tecnología'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'22','subcategoria'=>'Deportes y juegos'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'22','subcategoria'=>'Gastronomía'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'22','subcategoria'=>'Otros cursos'));
				
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'23','subcategoria'=>'Servicios domésticos'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'23','subcategoria'=>'Lavado y lavandería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'23','subcategoria'=>'Costura-modista '));
		DB::table('subcategorias')->insert(array('categoria_id'=>'23','subcategoria'=>'Cuidado de niños'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'23','subcategoria'=>'Zapatero'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'23','subcategoria'=>'Seguridad'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'23','subcategoria'=>'Cuidado personas de tercera edad'));
		
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'24','subcategoria'=>'Artistas'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'24','subcategoria'=>'Disfraz'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'24','subcategoria'=>'Banquetes-catering'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'24','subcategoria'=>'Salones'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'24','subcategoria'=>'Show y animación'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'24','subcategoria'=>'Decoración para eventos'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'24','subcategoria'=>'Orquestas, discomovil, djs'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'24','subcategoria'=>'Otros'));
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'25','subcategoria'=>'Maquillaje y estética'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'25','subcategoria'=>'Depilación'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'25','subcategoria'=>'Corte y peinado de cabello'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'25','subcategoria'=>'SPA y masaje'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'25','subcategoria'=>'Otros'));
		
		$this->command->info('subcategorias sembradas en la tabla sub categorias perteneciente a servicios');
	
		DB::table('subcategorias')->insert(array('categoria_id'=>'27','subcategoria'=>'Vendedor'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'27','subcategoria'=>'Asesor'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'27','subcategoria'=>'Auxiliar-Ayudante'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'27','subcategoria'=>'Atención al cliente'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'27','subcategoria'=>'Cajero'));
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'28','subcategoria'=>'Enfermero'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'28','subcategoria'=>'Auxiliar de farmacia'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'28','subcategoria'=>'Odontólogo'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'28','subcategoria'=>'Auxiliar de enfermería'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'28','subcategoria'=>'Psicólogo-psiquiatra'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'28','subcategoria'=>'Odontopediatra'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'28','subcategoria'=>'Nutricionista'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'28','subcategoria'=>'Masajista'));
				
		DB::table('subcategorias')->insert(array('categoria_id'=>'29','subcategoria'=>'Técnico para computadora'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'29','subcategoria'=>'Técnico para celular'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'29','subcategoria'=>'Electrónico'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'29','subcategoria'=>'Otros técnicos'));
				
		DB::table('subcategorias')->insert(array('categoria_id'=>'30','subcategoria'=>'Limpieza doméstica'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'30','subcategoria'=>'Portero'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'30','subcategoria'=>'Lavado'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'30','subcategoria'=>'Costura y confección'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'30','subcategoria'=>'Niñera'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'30','subcategoria'=>'Guardián'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'30','subcategoria'=>'Entrenador'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'30','subcategoria'=>'Fotógrafo'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'30','subcategoria'=>'Peluquero'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'30','subcategoria'=>'Maquillaje'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'30','subcategoria'=>'Estilista'));
				
		DB::table('subcategorias')->insert(array('categoria_id'=>'31','subcategoria'=>'Profesor de primaria'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'31','subcategoria'=>'Profesor de secundaria'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'31','subcategoria'=>'Docente universitario'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'31','subcategoria'=>'Idiomas'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'31','subcategoria'=>'Educador especial'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'31','subcategoria'=>'Docente de informática'));
				
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Auditor'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Arquitecto'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Comunicador social'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Asesor'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Contador'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Abogado'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Economista'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Diseñador de interiores'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Programador o analista de sistemas'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Ingeniero'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Investigador'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Traductor o intérprete'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'32','subcategoria'=>'Veterinario'));
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'33','subcategoria'=>'Personal para hotel'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'33','subcategoria'=>'Chef'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'33','subcategoria'=>'Cocinero'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'33','subcategoria'=>'Ayudante de cocina'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'33','subcategoria'=>'Panadero o pastelero'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'33','subcategoria'=>'Barman'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'33','subcategoria'=>'Mesero-camarero'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'33','subcategoria'=>'Otro'));
				
		DB::table('subcategorias')->insert(array('categoria_id'=>'34','subcategoria'=>'Chofer profesional'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'34','subcategoria'=>'Ayudante para mecánica'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'34','subcategoria'=>'Personal para Transporte'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'34','subcategoria'=>'Motorizado'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'34','subcategoria'=>'Personal para Turismo'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'34','subcategoria'=>'Guía turístico'));
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'35','subcategoria'=>'Diseñador gráfico'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'35','subcategoria'=>'Diseñador de multimedia'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'35','subcategoria'=>'Diseñador web'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'35','subcategoria'=>'Auxiliar para Imprenta o papelería'));
				
		DB::table('subcategorias')->insert(array('categoria_id'=>'36','subcategoria'=>'Administrador'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'36','subcategoria'=>'Auxiliar'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'36','subcategoria'=>'Asistente'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'36','subcategoria'=>'Secretaria-Telefonista'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'36','subcategoria'=>'Recepcionista'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'36','subcategoria'=>'Director'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'36','subcategoria'=>'Gerente'));
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'37','subcategoria'=>'Albañil'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'37','subcategoria'=>'Carpintero'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'37','subcategoria'=>'Cerrajero-Soldador'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'37','subcategoria'=>'Electricista'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'37','subcategoria'=>'Jardinero'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'37','subcategoria'=>'Pintor'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'37','subcategoria'=>'Plomero'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'37','subcategoria'=>'Ayudante'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'37','subcategoria'=>'Limpieza de oficinas'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'37','subcategoria'=>'Otro'));
		
		
		DB::table('subcategorias')->insert(array('categoria_id'=>'38','subcategoria'=>'Pasantías colegio'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'38','subcategoria'=>'Pasantías universidad'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'38','subcategoria'=>'Recién graduado'));
		DB::table('subcategorias')->insert(array('categoria_id'=>'38','subcategoria'=>'Empleo por vacaciones'));
		
		$this->command->info('subcategorias sembradas en la tabla sub categorias perteneciente a empleos');
		
		
		DB::table('politicas')->insert(array('descripcion'=>'1. Alucinógenos, bebidas alcohólicas, o cualquier tipo de droga.'));
		DB::table('politicas')->insert(array('descripcion'=>'2. Sustancias que contenga esteroides o anabolizantes.'));
		DB::table('politicas')->insert(array('descripcion'=>'3. Medicamentos para la salud de humanos o animales.'));
		DB::table('politicas')->insert(array('descripcion'=>'4. Servicio de acompañantes, prostitución o todo tipo de servicio sexual.'));
		DB::table('politicas')->insert(array('descripcion'=>'5. Pornografía o contenido no apto para menores de edad.'));
		DB::table('politicas')->insert(array('descripcion'=>'6. Cualquier tipo de discriminación.'));
		DB::table('politicas')->insert(array('descripcion'=>'7. Información que promueva la violencia.'));
		DB::table('politicas')->insert(array('descripcion'=>'8. Armas de fuego, municiones o material explosivo. '));
		DB::table('politicas')->insert(array('descripcion'=>'9. Artículos o productos de dudosa procedencia.'));
		DB::table('politicas')->insert(array('descripcion'=>'10. Software para vulnerar dispositivos electrónicos.  '));
		DB::table('politicas')->insert(array('descripcion'=>'11. Anuncio sobre préstamos o créditos financieros.'));
		DB::table('politicas')->insert(array('descripcion'=>'12. Equipos para obtener servicios de forma gratuita siendo estos de paga.'));
		DB::table('politicas')->insert(array('descripcion'=>'13. Ofrecer documentos personales de forma ilegal.'));
		DB::table('politicas')->insert(array('descripcion'=>'14. Objetos considerados patrimonio histórico y cultural del Ecuador.'));
		DB::table('politicas')->insert(array('descripcion'=>'15. Contenidos que promuevan peleas de animales.'));
		DB::table('politicas')->insert(array('descripcion'=>'16. Fotografías donde se exhiban restos de animales.'));
		DB::table('politicas')->insert(array('descripcion'=>'17. Venta de flora o fauna en peligro de extinción.'));
		DB::table('politicas')->insert(array('descripcion'=>'18. Servicios para la realización de abortos.'));
		DB::table('politicas')->insert(array('descripcion'=>'19. Servicios de realización de documentos estudiantiles.'));
		DB::table('politicas')->insert(array('descripcion'=>'20. Boletos de lotería, rifas, bingos o máquinas de azar.'));
		DB::table('politicas')->insert(array('descripcion'=>'21. Ofertas de trabajo donde no se detalle que trabajo se realizaría. '));
		
		
		$this->command->info('Politicas sembradas en tabla politicas');


		DB::table('configuraciones')->insert(array('anunciosadministrador'=>'30', 
													'anunciosusuario'=>'10',
													'anunciosbloqueados'=>'3',
													'comentariosbloqueados'=>'3',
													'contadordedenuncias'=>'20',
													'solicitudes'=>'NO',


													));
		
		$this->command->info('Configuracion del Sistema Miradita establecida');
		
	}

}


