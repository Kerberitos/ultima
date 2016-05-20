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
						<li  class="active">
							<a href="{{route('ayuda.pagina3')}}">
							<i class="glyphicon glyphicon-user"></i>
							Perfil y cuenta de usuario </a>
						</li>
						<li>
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
         		<p class="titulo-contenido-ayuda">PERFIL Y CUENTA DE USUARIO</p>


         		<a href="#foto" title="" class="enlace"><p>Foto de perfil</p></a>
         		<a href="#datosgenerales" title="" class="enlace"><p>Datos generales de usuario</p></a>
         		<a href="#cuentadeusuario" title="" class="enlace"><p>Cuenta de usuario</p></a>
         		<p class="mini-subtitulo-ayuda">Accediendo a mi perfil y cuenta.</p>
         		<p>Para poder visualizar su perfil de usuario previamente debe iniciar sesión en Miradita Loja.
				</p>

				<p>
					Cuando inicia sesión podrá ver al final de la barra de menú su nombre, el cual es un menú desplegable, desde ese menú podrá acceder a algunas funcionalidades que son reservadas para usuarios registrados en Miradita Loja.
				</p>
         		<img src="{{ asset('assets/images/help/17_menu_user.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
         		<p>Para acceder a su perfil de usuario, siga los siguientes pasos:</p>
         		<p>1. Presione su nombre para desplegar el menú.</p>
         		<p>Al desplegarse el menú seleccione la opción “Mi perfil”</p>

         		

         		<img src="{{ asset('assets/images/help/18_perfil.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

         		<p>En este espacio podrá encontrar todo lo concerniente a su información general (nombres, género, número de teléfono celular y convencional) y opciones sobre su cuenta de usuario (modificar correo, eliminar contraseña, eliminar cuenta). Además como usuario tiene la opción de cambiar su foto de perfil si lo desea.</p>



         		<a name="foto" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">a. ¿Cómo cambio mi foto de perfil?</p></a>
            	<p>1. Para cambiar su foro de perfil seleccione el botón “CAMBIAR FOTO” de la pantalla Perfil.</p>
            	<p>Aparecerá un nuevo formulario para seleccionar una nueva foto de perfil.</p>


				<img src="{{ asset('assets/images/help/19_fotoperfil.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

				<p>2. Si desea cambiar de foto, seleccione Buscar foto, considerar que esta foto solo puede tener formato jpg o png y su tamaño no puede superar los 3MB  </p>

				<p>3. Finalmente presione Guardar.</p>



				<a name="datosgenerales" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">b. Datos generales.</p></a>


				<p>1. Para acceder a su información general seleccione la opción “Datos generales” de la pantalla Perfil.</p>
				<p>Se mostrará su información en la parte derecha, pero si está navegando desde un dispositivo de pantalla pequeña  podrá visualizar su información en la parte inferior.</p>
            	<img src="{{ asset('assets/images/help/20_informaciongeneral.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

            	<p>2. Si desea modificar sus datos, presione el botón Modificar datos.</p>
            	<p>3. Se mostrará un formulario en el cual solo debe ingresar sus datos y presionar Guardar. Algo importante de recalcar es que usted puede cambiar su nombre una sola vez.
            	</p>

           	<img src="{{ asset('assets/images/help/21_editardatos.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

           	<p>4. Si se guardó correctamente se visualizará un mensaje que lo confirme.</p>
           	<img src="{{ asset('assets/images/help/22_aviso_guardo_informacion.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

           	<a name="cuentadeusuario" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">c. Cuenta de usuario.</p></a>
           	<p>1. Para acceder a su Cuenta de usuario seleccione la opción “Mi cuenta” de la pantalla Perfil.</p>
           	<p>Se mostrará la información de su cuenta de usuario y las siguientes tres opciones.</p>

           	 
			<a href="#modificarcorreo" title="" class="enlace"><p>- Modificar correo.</p></a>
         	<a href="#modificarclave" title="" class="enlace"><p>- Modificar contraseña.</p></a>
         	<a href="#eliminarcuenta" title="" class="enlace"><p>- Eliminar mi cuenta.</p></a>


				<img src="{{ asset('assets/images/help/23_informacioncuenta.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">


				<a name="modificarcorreo" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">Modificar correo</p></a>



				<p>1. Presionar el botón Modificar correo.</p>
				<p>2. En el formulario Editar correo de la cuenta que aparece, ingresar el nuevo correo electrónico y por seguridad la contraseña de la cuenta de usuario en Miradita Loja.</p>


				<img src="{{ asset('assets/images/help/24_editarcorreo.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

				<p>3. Presione Guardar.</p>




				<a name="modificarclave" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">Modificar contraseña</p></a>




				<p>1. Presionar el botón Modificar contraseña. </p>

				<p>2. En el formulario Cambiar contraseña que aparece, ingrese la contraseña que utiliza actualmente y también la nueva contraseña con la cual desea remplazar.</p>

				<img src="{{ asset('assets/images/help/25_cambiarclave.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
				<p>3. Presione Guardar.</p>

				<a name="eliminarcuenta" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">Eliminar cuenta de Miradita Loja</p></a>




				<p>1. Presionar el botón Eliminar mi cuenta.</p>

				<p>2. En el formulario Eliminar mi cuenta que aparece, ingrese la contraseña de su cuenta de usuario.</p>

				<img src="{{ asset('assets/images/help/26_eliminarcuenta.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
				<p>3. Presione el botón Eliminar mi cuenta si realmente desea eliminar su cuenta de Miradita Loja.</p>



            </div>
		</div>

	</div>	

</div>	
       

@stop
