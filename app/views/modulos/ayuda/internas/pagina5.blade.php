@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	@include('modulos.ayuda.internas.encabezado')
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4">
			<!-- SIDEBAR MENU -->
				<div class="menu-ayuda">
					<ul class="nav">
						
						<li >
							<a href="{{route('ayuda')}}">
							<i class="icon-checkmark"></i>
							Ayuda </a>
						</li>
						<li>
							<a href="{{route('ayuda.pagina2')}}">
							<i class="icon-user-add"></i>
							Registro e inicio de sesión </a>
						</li>
						<li>
							<a href="{{route('ayuda.pagina3')}}">
							<i class="glyphicon glyphicon-user"></i>
							Perfil y cuenta de usuario </a>
						</li>
						<li >
							<a href="{{route('ayuda.pagina4')}}">
							<i class="icon-clipboard-3"></i>
							Tipos de anuncios </a>
						</li>
						<li  class="active">
							<a href="{{route('ayuda.pagina5')}}">
							<i class="icon-bullhorn"></i>
							Crear y publicar anuncios </a>
						</li>
						<li>
							<a href="{{route('ayuda.pagina6')}}">
							<i class="icon-pencil-2"></i>
							Gestiona tus anuncios </a>
						</li>
						<!--li>
							<a href="{{route('ayuda.pagina7')}}">
							<i class="icon-microphone"></i>
							Comunicación</a>
						</li-->
					</ul>
				</div>
				<!-- END MENU -->

		</div>	

		<div class="col-xs-12 col-sm-8 col-md-8">
            <div class="contenido-ayuda parrafo-ayuda">
         		<p class="titulo-contenido-ayuda">CREAR Y PUBLICAR ANUNCIOS</p>
         		<a href="#crear" title="" class="enlace"><p>Crear anuncio</p></a>
         		<a href="#publicar" title="" class="enlace"><p>Publicar anuncio</p></a>


         		<a name="crear" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">a. ¿Cómo creo un anuncio?</p></a>
         		<p>Para crear un anuncio es necesario que inicie sesión previamente en Miradita Loja.</p>
         		<p>Siga los siguientes pasos para crear un anuncio:</p>
         		<p>1. Seleccione el botón CREAR ANUNCIO que se encuentra en la parte superior de la pantalla.</p>

         		<img src="{{ asset('assets/images/help/30_btn_crearanuncio.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

         		<p>2. Se mostrará una ventana dónde se debe elegir lo siguiente:</p>

         		<img src="{{ asset('assets/images/help/31_primerpaso.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

         		<p>- La <span class="texto-negrita">sección</span> sección en la cual irá el anuncio, pudiendo ser clasificados, servicios o empleos.</p>

         		<p>- La <span class="texto-negrita">categoría</span>, se debe elegir de una lista de categorías las cuales varían dependiendo de la sección que se haya elegido.</p>
         		<p>- La <span class="texto-negrita">subcategoría</span>, se elige de una lista de subcategorías las cuales varían dependiendo de la categoría elegida.</p>
         		<p>- La opción de lo <span class="texto-negrita">que desea hacer</span>, estas opciones se cargan dependiendo de la sección seleccionada.</p>
         		
         		<p>Observemos las diferentes opciones para elegir dependiendo de la sección, es decir las <a class="enlace" href="#opcionesclasificados" title="">opciones para clasificados</a>, <a class="enlace" href="#opcionesservicios" title="">opciones para servicios</a> y <a class="enlace" href="#opcionesempleos" title="">opciones para empleos</a> </p>




         		
         		<a name="opcionesclasificados" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">Para Clasificados se tienen las siguientes opciones:</p></a>
         		<img src="{{ asset('assets/images/help/32_opcion_clasificado.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
         		<p><span class="texto-negrita">Yo vendo.-</span> Cuando usted desea vender algo.</p>
         		<p><span class="texto-negrita">Yo alquilo.-</span> Cuando usted desea poner en alquiler un producto o bien.</p>
         		<p><span class="texto-negrita">Quiero comprar.-</span> Si usted está buscando algún producto o bien para comprar.</p>
         		<p><span class="texto-negrita">Busco alquiler.-</span> Cuando usted busca alquilar un producto o bien.</p>
         		<p><span class="texto-negrita">Intercambio.-</span> Cuando usted desea intercambiar un producto o bien por otro.</p>

         		<a name="opcionesservicios" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">Para Servicios se tiene una sola opción:</p></a>
         		<img src="{{ asset('assets/images/help/33_opcion_servicio.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
         		<p><span class="texto-negrita">Ofrezco servicio.-</span> Cuando usted desea ofrecer un servicio, ya sea como particular o como empresa/negocio.</p>
         		

         		<a name="opcionesempleos" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">Para Empleos se tienen las siguientes opciones:</p></a>
         		<img src="{{ asset('assets/images/help/34_opcion_empleo.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
         		<p><span class="texto-negrita">Necesito trabajo.-</span> Cuando usted busca trabajo.</p>
         		<p><span class="texto-negrita">Ofrezco trabajo.--</span> Cuando usted desea ofrecer un trabajo, ya sea como particular o como empresa.</p>
         		<p><span class="texto-negrita">Pasantías.-</span> Cuando desea solicitar un espacio para realizar pasantías o como empresa desea indicar que tiene vacantes para pasantes.</p>
         		
         		<p>3. Una vez elija estas opciones presione el botón SIGUIENTE PASO.</p>
         		
         		<p>4. Se mostrará una nueva ventana con un formulario el cual debe rellenar, pero este formulario dependerá de la sección en la cual se está creando el anuncio.</p>
         		<p>Es importante que conozca las partes del formulario y sus variaciones dependiendo de cada sección.</p>

         		<a name="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">Partes de un formulario para crear anuncio.</p></a>

         		<p>Todos los campos con asterisco <span class="texto-negrita"> (*)</span> son obligatorios rellenar o seleccionar.</p>
         		<p class="texto-negrita">i. Información sobre sección y categoría.</p>
         		<p>[Presente en el formulario de clasificados, servicios y empleos.]</p>

         		<p>Indica la información del anuncio como: sección, categoría, subcategoría y lo que deseas hacer como anunciante.</p>
         		<img src="{{ asset('assets/images/help/35_detalles_anuncio.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

         		<p class="texto-negrita">ii. Información del anuncio.</p>
         		<p>[Presente en el formulario de clasificados, servicios y empleos.]</p>
         		<p>Aquí se encuentra el título y la descripción del anuncio.</p>

         		<img src="{{ asset('assets/images/help/36_informacion_anuncio.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

         		<p><span class="texto-negrita">El título</span> debe contener mínimo 30 caracteres y máximo 100.</p>
         		<p><span class="texto-negrita">La descripción</span> debe contener mínimo 30  caracteres y máximo 500. En la parte superior de la descripción se va indicando constantemente el número de caracteres que aún puede escribir.</p>
         		<img src="{{ asset('assets/images/help/37_campo_descripcion.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
         		<p>Además considere que cuando escriba en el campo descripción puede utilizar la tecla Enter para ir a una nueva línea y también guiones para poder dar una mejor presentación a su anuncio.</p>
         		<p>Además considere que cuando escriba en el campo descripción puede utilizar la tecla Enter para ir a una nueva línea y también guiones para poder dar una mejor presentación a su anuncio.</p>

         		<p class="texto-negrita">iii. Fotos.</p>
         		<p>[Esta parte está presente solo en el formulario de clasificados y servicios, en anuncios sobre empleos no se requiere  adjuntar ninguna foto.]</p>
         		<img src="{{ asset('assets/images/help/38_fotos.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
         		<p>La foto que se suba debe tener formato .jpg o .png y su tamaño no debe superar los 3MB.</p>
         		<p>En el formulario de clasificados se pueden subir hasta cuatro fotos, mientras que en el formulario de servicios solo hay como subir una foto, y en el formulario de empleos no se visualiza ningún campo foto.</p>

         		<p class="texto-negrita">iv. Información adicional.</p>
         		<p>[Presente en el formulario de clasificados y empleos.]</p>
         		<p>El segmento de información adicional varía tanto en el formulario de clasificados como del formulario empleos.</p>

         		<p>- En el formulario de Clasificados, en Información adicional se encuentran los campos: estado, precio y opción del precio.</p>

         		

         		<img src="{{ asset('assets/images/help/39_informacion_adicional.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">


         		<p>El <span class="texto-negrita">estado </span> permite indicar el estado del producto o bien, pudiendo ser nuevo o usado.</p>
         		<p>El <span class="texto-negrita">precio</span> debe contener solo números, es el precio del producto o bien.</p>
         		<p>La <span class="texto-negrita">opción del precio</span> sirve para especificar si el precio es negociable o no.</p>


         		<p>- En el formulario de Empleos, en el apartado de Información adicional se encuentran los campos: sueldo estimado, tipo de empleo.</p>
         		<img src="{{ asset('assets/images/help/40_informacion_adic_empleo.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
         		<p><span class="texto-negrita">Sueldo estimado, </span>  en este campo va el sueldo estimado del anuncio de empleo.</p>
         		<p>El <span class="texto-negrita">tipo de empleo</span> permite indicar si el empleo es de tiempo completo, medio tiempo, temporal o por horas. </p>


         		<p class="texto-negrita">v. Información del anunciante.</p>
         		<p>[Presente en el formulario de clasificados, servicios y empleos.]</p>
         		<p>Aquí se encuentran los campos: anunciante, celular, compañía de celular, whatsapp, teléfono.</p>

         		<img src="{{ asset('assets/images/help/41_informacion_anunciante.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
         		<p><span class="texto-negrita">A quién llamar </span>  permite indicar el nombre del anunciante, es decir con quién se debe contactar.</p>
         		<p>En <span class="texto-negrita">celular</span> se debe ingresar el número de celular del anunciante. </p>


         		<p><span class="texto-negrita">Compañía de celular</span> permite indicar la compañía a la cual pertenece el número de celular del anunciante, pudiendo ser Claro, Cnt o Movistar.</p>
         		<p><span class="texto-negrita">Usa whatsapp </span>  indica si el anunciante usa whatsapp o no.</p>
         		<p><span class="texto-negrita">Teléfono convencional </span> es un campo opcional, si desea puede llenarlo o no.</p>
         		<p><span class="texto-negrita">Eres </span> permite indicar si el anunciante es particular o una empresa.</p>

         		<p>5. Finalmente una vez haya rellenado correctamente el correspondiente formulario presione CREAR ANUNCIO.</p>


         		<a name="publicar" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">b. ¿Cómo publico mi anuncio?</p></a>
         		<p>En Miradita Loja los anuncios antes de ser publicados son revisados por un miembro del equipo de administradores. Si el anuncio que solicitó ser publicado no incumple ninguna Norma de uso del sitio web, entonces un administrador da paso a la publicación de tu anuncio en Miradita Loja.</p>
         		<p>Para solicitar a un administrador que su anuncio se publique, tiene dos opciones:</p>
         		<p  class="mini-subtitulo-ayuda">i. Solicitar publicación después de crear anuncio.</p>
         		<p>Luego de crear correctamente el anuncio, se mostrará un mensaje, dónde usted puede seleccionar si desea solicitar que su anuncio se publique.</p>

         		<img src="{{ asset('assets/images/help/42_solicita_publicar.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

         		<p>1. Presione el botón Deseo publicar.</p>
         		<p>2. Observará un aviso informando que la solicitud para publicar se envió correctamente a un administrador.</p>

         		<img src="{{ asset('assets/images/help/43_aviso_publicación.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

         		<p  class="mini-subtitulo-ayuda">ii. Solicitar publicación desde Tus anuncios.</p>
         		<p>Usted debe previamente iniciar sesión en Miradita Loja.</p>
         		<p>1. Seleccionar la opción “Mis anuncios” del menú de usuario registrado el cual se encuentra en el menú de navegación superior.</p>

         		<img src="{{ asset('assets/images/help/44_menu_mis_anuncios.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">	

         		<p>2. En la pantalla Mis anuncios, observará que los anuncios con estado Creado tienen la opción de elegir el botón PUBLICAR ANUNCIO. </p>

         		<img src="{{ asset('assets/images/help/45_mis_anuncios.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">	

         		<p>3. Presione PUBLICAR ANUNCIO para solicitar que su anuncio sea publicado en Miradita Loja.</p>
         		<p>4. Se mostrará un aviso dónde usted debe confirmar si realmente desea solicitar publicación, presione Publicar.</p>

         		<img src="{{ asset('assets/images/help/46_aviso_flotante_publicar.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">	

         		<p>5. Observará un aviso informando que la solicitud para publicar se envió correctamente a un administrador.</p>
         		<img src="{{ asset('assets/images/help/43_aviso_publicación.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">



            </div>
		</div>

	</div>	

</div>	
       

@stop
