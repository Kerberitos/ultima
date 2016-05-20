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
						<li >
							<a href="{{route('ayuda.pagina5')}}">
							<i class="icon-bullhorn"></i>
							Crear y publicar anuncios </a>
						</li>
						<li  class="active">
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
         		<p class="titulo-contenido-ayuda">GESTIONA TUS ANUNCIOS</p>
         		<a href="#estados" title="" class="enlace"><p>Estados de anuncios</p></a>
         		<a href="#acciones" title="" class="enlace"><p>Acciones sobre anuncio</p></a>

               <p class="mini-subtitulo-ayuda">Accediendo a Mis anuncios.</p>
               <p>Para acceder dónde se encuentran sus anuncios siga los siguientes pasos:</p>

               <p>1. En el menú de navegación superior se encuentra el Menú de usuario registrado, dentro de este menú seleccione la opción “Mis anuncios”.</p>

               <img src="{{ asset('assets/images/help/44_menu_mis_anuncios.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
               <p>2. Se abrirá la pantalla Mis anuncios en la cual podrá observar todos los anuncios que ha creado.</p>

               <p>Ahí podrá revisar en cada cada anuncio lo siguiente:</p>

               <p>- Título del anuncio.</p>
               <p>- Sección en la cual está creado.</p>
               <p>- Imagen pequeña si el anuncio posee imágenes adjuntas.</p>
               <p>- Fecha de creación y última actualización.</p>
               <p>- Estado que posee el anuncio.</p>


               <p>Algo importante de conocer es los estados que puede tener un anuncio en Miradita Loja.</p>

         		<a name="estados" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">a. ¿Qué estados puede tener un anuncio?</p></a>
               <p>Un anuncio puede tener seis estados, a continuación se indican cada uno de ellos:</p>


         		<p><span class="texto-negrita">Publicado:</span> Cuando su anuncio se encuentra activo y publicado, con este estado su anuncio puede ser visualizado por los usuarios de Miradita Loja sin ningún problema.</p>
          		<img src="{{ asset('assets/images/help/47_publicado.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

         		
               <p><span class="texto-negrita">Creado:</span> Cuando su anuncio ha sido creado correctamente, pero usted aún no ha solicitado su publicación, con este estado su anuncio solo es visualizado por usted.</p>
               <img src="{{ asset('assets/images/help/48_creado.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

               <p><span class="texto-negrita">Bloqueado:</span> Cuando su anuncio ha sido bloqueado por un administrador de Miradita Loja por incumplir algún Término o condición de uso del sitio. </p>
               <p>Importante considerar que si usted llega a tener tres anuncios bloqueados por los administradores, su cuenta de usuario automáticamente será suspendida sin poder acceder al sitio.</p>
               <img src="{{ asset('assets/images/help/49_bloqueado.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

               <p><span class="texto-negrita">Revisión:</span> Cuando su anuncio está siendo revisado por un administrador de Miradita Loja, esto después de que haya solicitado sea publicado en el sitio.</p>
               <img src="{{ asset('assets/images/help/50_revision.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

               <p><span class="texto-negrita">Denunciado:</span> Cuando su anuncio ha sido denunciado por otro usuario, debido a que considera que incumple algún Término o condición de uso de Miradita Loja. </p>
               <p>No se preocupe, en menos de 12 horas su anuncio será revisado por un administrador y si considera que no infringe ninguna norma será publicado nuevamente. </p>
               <img src="{{ asset('assets/images/help/51_denunciado.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

               <p><span class="texto-negrita">Rechazado:</span> Cuando solicitó que su anuncio sea publicado, pero no logró pasar la revisión por parte de un administrador. Puede editar y corregir lo que impidió que su anuncio sea publicado y solicitar nuevamente su publicación.</p>
               <p>Normalmente el administrador le enviará un mensaje indicando el motivo por el cual no pasó la revisión.</p>
               <img src="{{ asset('assets/images/help/52_rechazado.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

              
               <a name="acciones" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">b. ¿Qué acciones se pueden realizar sobre un anuncio?</p></a>
               <p>Entre las acciones que puede realizar sobre cada anuncio creado por usted se encuentran: ver anuncio, editar, eliminar, publicar y desactivar anuncio.</p>
               <img src="{{ asset('assets/images/help/53_acciones.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

               <p class="mini-subtitulo-ayuda">VER ANUNCIO</p>
               <p>Usted puede visualizar su anuncio tal como lo ven el resto de usuarios de Miradita Loja.</p>
               <p>1. Presione el botón VER y observará el anuncio con toda su información. </p>

               <p class="mini-subtitulo-ayuda">EDITAR ANUNCIO</p>
               <p>Usted podrá modificar la información de su anuncio.</p>
               <p>1. Presione el botón EDITAR, se abrirá un formulario para editar.</p>
               <p>2. Modifique la información que necesite.</p>
               <p>3. Presione GUARDAR.</p>



               <p class="mini-subtitulo-ayuda">ELIMINAR ANUNCIO</p>

               <p>Usted podrá eliminar su anuncio.</p>

               <p>1. Presione el botón ELIMINAR.</p>
               <p>2. Se mostrará un mensaje de confirmación, para verificar si realmente desea eliminar su anuncio.</p>

               <img src="{{ asset('assets/images/help/54_aviso_borrar.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
               <p>3. Presione Borrar si desea eliminar definitivamente su anuncio.</p>



               <p class="mini-subtitulo-ayuda">PUBLICAR ANUNCIO</p>
               <p>1. Si su anuncio se encuentra con estado Creado, simplemente presione el botón PUBLICAR ANUNCIO para solicitar que su anuncio sea publicado en Miradita Loja.</p>
               <p>2. Se mostrará un aviso dónde usted debe confirmar si realmente desea solicitar publicación, presione Publicar.</p>
               <img src="{{ asset('assets/images/help/46_aviso_flotante_publicar.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

               <p>3. Observará un aviso informando que la solicitud para publicar se envió correctamente a un administrador.</p>
               <img src="{{ asset('assets/images/help/43_aviso_publicación.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

               <p class="mini-subtitulo-ayuda">DESACTIVAR ANUNCIO</p>
               <p>1. Si su anuncio se encuentra con estado Publicado, simplemente presione el botón DESACTIVAR ANUNCIO.</p>

               <p>2. Se mostrará un aviso dónde usted debe confirmar si realmente desea desactivar su anuncio, presione Desactivar.</p>

                <img src="{{ asset('assets/images/help/55_aviso_flotante_desactivar.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

               <p>3. Observará un aviso informando que su anuncio ha sido desactivado correctamente.</p>
                <img src="{{ asset('assets/images/help/56_aviso_desactivado.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">



            </div>
		</div>

	</div>	

</div>	
       

@stop
