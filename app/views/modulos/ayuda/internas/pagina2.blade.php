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
						<li class="active">
							<a href="{{route('ayuda.pagina2')}}">
							<i class="icon-user-add"></i>
							Registro e inicio de sesión </a>
						</li>
						<li>
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
         		<p class="titulo-contenido-ayuda">REGISTRO E INICIO DE SESIÓN</p>


         		<a href="#registro" title="" class="enlace"><p>Registro en Miradita Loja</p></a>
         		<a href="#ingreso" title="" class="enlace"><p>Iniciar sesión en Miradita Loja</p></a>
         		<a href="#recuperarclave" title="" class="enlace"><p>Recuperar contraseña</p></a>


         		<a name="registro" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">a. ¿Cómo me registro en el sitio web?</p></a>
            	<p>Primeramente debe seleccionar el botón REGISTRATE de la parte superior derecha de la pantalla, lo cual abre la pantalla Regístrate.</p>
            	<img src="{{ asset('assets/images/help/1_botones_registro.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">


            	<p>Hay dos opciones para registrarse en el sitio, la primera opción es crear una cuenta de usuario utilizando un <a class="enlace" href="#registrocorreo" title=""> correo electrónico válido</a>  y la segunda es utilizar <a class="enlace" href="#sociallogin" title=""> Social Login</a>.</p>



            	<img src="{{ asset('assets/images/help/2_formulario_reg.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

            	<a name="registrocorreo" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">Registro con correo electrónico.</p></a>
            	
            	<p>Para registrarse en Miradita Loja mediante correo electrónico debe seguir los siguientes pasos:</p>
            	<p>1. Debe rellenar correctamente el formulario que se visualiza en la pantalla Regístrate.</p>
            	<p>En caso de que un campo del formulario no sea rellenado correctamente, se mostrará un mensaje junto al mismo informando del error</p>



            	<img src="{{ asset('assets/images/help/3_form_correcto.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

            	<p>2. Presione el botón Registrarse.</p>

				<p>Si se envía correctamente el formulario visualizará un aviso indicando que debe activar la cuenta creada en Miradita Loja..</p>

				<img src="{{ asset('assets/images/help/4_aviso_ activacion.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
				

				<p>3. Abra la cuenta de correo electrónico que proporcionó, recibirá un mensaje  el cual  contendrá el enlace de activación, presionar el botón ACTIVAR CUENTA para activar la cuenta de Miradita Loja.</p>

				<img src="{{ asset('assets/images/help/5_correo_activacion.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">


				<p>Una vez presione el enlace de activación y si se realiza correctamente el proceso, se mostrará un aviso indicando la correcta activación de su cuenta en Miradita Loja. Ahora ya puede iniciar sesión en el sitio y disfrutar de todas sus funcionalidades.</p>



				<img src="{{ asset('assets/images/help/6_aviso_activado_ok.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">



				<a name="sociallogin" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">Registro o ingreso con una red social. (Social Login)</p></a>
				<p>Social login es un método el cual consiste en que usted puede utilizar una cuenta activa de facebook, twitter o google plus para conectarse con el sitio de Miradita Loja. </p>

				<p>Para conectarse en Miradita Loja mediante una red social debe seguir los siguientes pasos:</p>

				<p>1. En la pantalla Regístrate seleccione el botón de la red social con la que desea conectarse, a continuación se mostrará una ventana donde debe iniciar sesión con la red social seleccionada.</p>



				<img src="{{ asset('assets/images/help/7_conectar_ f.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">


				<p>Una vez inicie sesión con facebook, la aplicación de Miradita Loja le pedirá autorización para obtener cierta información como dirección de correo electrónico, género y nombres desde facebook. </p>

				<p>2. Presione Aceptar y usted estará registrado en Miradita Loja y automáticamente su cuenta estará activada y lista para ser utilizada.</p>

				

				<img src="{{ asset('assets/images/help/8_permiso_app_f.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">	


				<p>Una vez ingrese a Miradita Loja con una red social se mostrará un aviso de bienvenida.</p>



				<img src="{{ asset('assets/images/help/9_aviso_ingreso_f.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">	

				<p>Ahora ya puede disfrutar de todas las funcionalidades de Miradita Loja.</p>


         		<a name="ingreso" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">b. ¿Cómo inicio sesión en Miradita Loja?</p></a>
         		<p>Para iniciar sesión en Miradita Loja con su cuenta de usuario siga los siguientes pasos:
         		</p>
         		<p>1. Presione el botón INGRESA de la parte superior derecha, se visualizará el siguiente formulario.</p>

         		<img src="{{ asset('assets/images/help/10_iniciar_sesion.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

         		<p>2. Ingrese las credenciales de cuenta de usuario, es decir su correo electrónico y contraseña en los campos correspondientes.</p>
         		<p>3. Presione Ingresar.</p>
         		<p>4. Se mostrará un aviso de bienvenida.</p>

         		

         		<img src="{{ asset('assets/images/help/11_aviso_ingreso_correcto.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">


         		<a name="recuperarclave" title="" class="enlace-subtitulo-ayuda"><p class="mini-subtitulo-ayuda">c. ¿Qué hago si olvido mi contraseña?</p></a>
         		

         		<p>Si olvida la contraseña de su cuenta de usuario, debe seguir los siguientes pasos para recuperarla:</p>

         		<p>1. Presione el botón INGRESA que se encuentra en la parte superior derecha.</p>

         		<p>2. En la pantalla que se muestra, seleccione el enlace “¿Has olvidado tu contraseña?”, el cual se encuentra en la parte inferior del formulario de Inicio de sesión.</p>
    		
         		<img src="{{ asset('assets/images/help/12_recupera_clave.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
	
         		<p>3. Se mostrará un formulario donde se debe ingresar el correo electrónico con el cual se encuentra registrado en el sitio web.</p>

         		<img src="{{ asset('assets/images/help/13_email_recupera_clave.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">

         		<p>4. Presione Buscar. Si el correo ingresado es correcto y se encuentra registrado en Miradita Loja se enviará a su correo electrónico un mensaje con el link de recuperación. </p>

         		<img src="{{ asset('assets/images/help/14_aviso_revise_correo.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">
         		<p>5. Ingrese a su cuenta de correo electrónico y presione el enlace RECUPERAR CONTRASEÑA, si no visualiza en mensaje en la bandeja de entrada revise en Spam.</p>

         		<p>6. Aparecerá un nuevo formulario, ingrese su nueva contraseña y presione Guardar.</p>

         		<img src="{{ asset('assets/images/help/15_nueva_clave.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">


         		<p>7. Si el proceso se realizó correctamente observará un mensaje informando que su cuenta de Miradita Loja se encuentra lista para ser utilizada.</p>

         		

         		<img src="{{ asset('assets/images/help/16_aviso_cuentalista.jpeg') }}" alt="" class="img-thumbnail img-fluid center-block">



            </div>
		</div>

	</div>	

</div>	
       

@stop
