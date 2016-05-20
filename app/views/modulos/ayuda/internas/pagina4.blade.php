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
						<li >
							<a href="{{route('ayuda.pagina3')}}">
							<i class="glyphicon glyphicon-user"></i>
							Perfil y cuenta de usuario </a>
						</li>
						<li  class="active">
							<a href="{{route('ayuda.pagina4')}}">
							<i class="icon-clipboard-3"></i>
							Tipos de anuncios </a>
						</li>
						<li>
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
         		<p class="titulo-contenido-ayuda">TIPOS DE ANUNCIOS</p>

         		<p>En Miradita Loja se manejan tres tipos de anuncios:</p>

         		<a href="#clasificados" title="" class="enlace"><p>- Anuncios Clasificados.</p></a>
         		<a href="#servicios" title="" class="enlace"><p>- Anuncios sobre servicios.</p></a>
         		<a href="#empleos" title="" class="enlace"><p>- Anuncios sobre empleos.</p></a>

         		
         		<a name="foto" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda"> ¿Por qué se hace una diferencia entre anuncios?</p></a>


            	<p>La finalidad de dividir los anuncios en tres secciones es porque esto permite organizar y mantener ordenados los anuncios, brindando al usuario una mejor presentación y facilidad para buscar lo que realmente desea. </p>
            	<p>Veamos rápidamente como se diferencian los tres tipos de anuncios:</p>


				<a name="clasificados" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">a. Sección de anuncios clasificados.</p></a>


				<p><span class="texto-negrita">Los anuncios clasificados.-</span> Si un usuario desea anunciar que vende, alquila, intercambia o desea comprar un bien o artículo.</p>

				<p>Por ejemplo.</p>

				<p>Anunciante:</p>

				<p>- vende un celular nuevo.</p>
				<p>- desea colocar en alquiler un departamento.</p>
				<p>- busca alquilar una casa.</p>
				<p>- intercambiar un vehículo por un terreno.</p>
				<p>- busca comprar una bicicleta usada, etc.</p>


				<p>Todos estos tipos de anuncios se los enmarca como anuncios clasificados.</p>
				<p>Los anuncios clasificados se pueden encontrar en la sección clasificados, accediendo a través del menú de navegación principal, presionando la opción CLASIFICADOS.</p>
            	<img src="{{ asset('assets/images/help/27_barra_clasificados.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

            	
            	<a name="servicios" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">b. Sección de anuncios sobre servicios.</p></a>


				<p><span class="texto-negrita">Los anuncios sobre servicios.-</span> Si un usuario desea anunciar que brinda un servicio en Loja, ya sea como persona particular o como empresa.</p>

				<p>Por ejemplo.</p>

				<p>Anunciante:</p>

				<p>- tiene una papelería y desea que la ciudadanía lojana conozca que brinda ese servicio.</p>
				<p>- tiene una carpintería.</p>
				<p>- repara celulares.</p>
				<p>- brinda servicios de belleza y cuidado personal.</p>
				<p>- tiene un hotel.</p>
				<p>- tiene un camión y brinda el servicio de mudanzas, etc.</p>


				<p>Todos los anuncios dónde se haga referencia a brindar un servicio, se los enmarca como anuncios sobre servicios.</p>
				<p>Para visualizar los anuncios sobre servicios debe presionar la opción SERVICIOS del menú de navegación principal.</p>
            	<img src="{{ asset('assets/images/help/28_barra_servicios.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

            	<a name="empleos" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">c. Sección de anuncios sobre empleos.</p></a>


				<p><span class="texto-negrita">Los anuncios sobre empleos.-</span> Si un usuario desea anunciar que ofrece un trabajo ya sea como empresa o persona particular,  o sencillamente el anunciante necesita trabajo.</p>

				<p>Por ejemplo.</p>

				<p>Anunciante:</p>

				<p>- Es una empresa que se dedica a la venta de ropa y necesita contratar dos personas para ventas por un mes a tiempo completo.</p>
				<p>- Es un particular y necesita contratar un carpintero para elaboración de puertas.</p>
				<p>- Es chofer profesional y necesita trabajar como chofer dentro o fuera de la provincia.</p>
				<p>- Es estudiante y necesita trabajo por vacaciones, tiene experiencia como mesero.</p>
				


				<p>Todos los anuncios dónde se ofrezca o busque empleo, se los enmarca como anuncios sobre empleos.</p>
				<p>Para visualizar los anuncios sobre empleos debe presionar la opción EMPLEOS del menú de navegación principal.</p>
            	<img src="{{ asset('assets/images/help/29_barra_empleos.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">


            </div>
		</div>

	</div>	

</div>	
       

@stop
