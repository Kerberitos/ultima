@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	@include('modulos.ayuda.internas.encabezado')
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4">
			<!-- SIDEBAR MENU -->
				<div class="menu-ayuda">
					<ul class="nav">
						
						<li class="active">
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
         		<p class="titulo-contenido-ayuda">SECCIÓN AYUDA</p>
            	<p>En esta sección usted puede encontrar contenido a cerca de como funciona
            	el sitio web Miradita Loja y los principales elementos que la componen.</p>
            </div>
		</div>

	</div>	

</div>	
       

@stop
