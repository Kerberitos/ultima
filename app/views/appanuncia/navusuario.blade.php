<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <div class="noefecto">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#desplegable">
            <span class="sr-only">Toggle navigation</span>
           	<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
        </button>
    </div>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-left" id="desplegable">
   	<ul class="nav navbar-nav" id="main-menu">
       	<li class="{{ $current['main'] }}" title="Ir a inicio" >
       		<a href="{{ URL::route('main') }}">
       			<span class="glyphicon glyphicon-home"></span>
           			INICIO
           	</a>
       	</li>
       	<li class="{{ $current['clasificados']}}" title="Sección clasificados" >
       		<a href="{{ route('verclasificados') }}">
       			<span class="glyphicon glyphicon-list-alt"></span> 
           			CLASIFICADOS
       		</a>
       	</li>
       	<li class="{{ $current['servicios']}}" title="Sección servicios">
       		<a href="{{ route('verservicios') }}">
       			<span  class="glyphicon glyphicon-wrench"></span> 
           			SERVICIOS
       		</a>
       	</li>
        <li class="{{ $current['empleos']}}" title="Sección empleos">
        	<a href="{{ route('verempleos') }}">
        		<span  class="glyphicon glyphicon-briefcase"></span> 
         			EMPLEOS
        	</a>
        </li>
        <li class="{{ $current['busqueda']}}" title="Buscar">
            <a href="{{ route('busqueda') }}">
                <span  class="glyphicon glyphicon-search"></span> 
                   <span class="hidden-sm"> BUSCAR</span>
            </a>

        </li>
    
    @if (Auth::guest())    

        
            <li class="{{ $current['crearanuncio']}}" title="Crear un anuncio">
            	<a data-toggle="modal" data-target="#nologin">
                	<span  class="glyphicon glyphicon-pencil"></span> 
                		<span>CREAR ANUNCIO</span>
                </a>

            </li>
       


    @endif        
    
    @if (Auth::check())
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> 

                    {{Helper::nombre_simple(\Auth::user()->usuario->nombres)}}
                    <span class="caret"></span>
            </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('perfil',[Auth::user()->usuario->slug ]) }}" >
                            <span class="glyphicon glyphicon-user"></span> 
                            Mi perfil</a>
                    </li>
                
            @if(is_admin())    
                @if(Auth::user()->nav_avanzada==false)
                    <li>
                        <a href="{{ route('activar.menu.administrador') }}" >
                            <span class="glyphicon glyphicon-ok"></span> 
                            Activar panel administrador
                        </a>
                    </li>
                @elseif(Auth::user()->nav_avanzada==true)
                    <li>
                        <a href="{{ route('desactivar.menu.administrador') }}" >
                            <span class="glyphicon glyphicon-remove"></span> 
                            Desactivar panel administrador
                        </a>
                    </li>
                @endif
            @endif    
                    <li class="{{ $current['misanuncios']}}">
                        <a href="{{ route('misanuncios') }}" >
                            <span class=" icon-clipboard"></span> 
                            Mis anuncios 
                        </a>
                    </li>
                    <li class="{{ $current['mismensajes']}}">
                        <a href="{{ route('mismensajes') }}" >
                            <span class="icon-envelope-2"></span> 
                            Mensajes 
                               
                                @if(Auth::user()->usuario->alerta)

                                    @if( Auth::user()->usuario->alerta->msm!=0)
                                        <span class="badge">
                                            {{ Auth::user()->usuario->alerta->msm}}
                                        </span>        
                                    @endif

                                @endif
                        </a>
                    </li>
                    
                    <li class="{{ $current['notificaciones']}}">
                        <a href="{{ route('misnotificaciones') }}" >

                            <span class="icon-bell-2"></span> 
                            Notificaciones 
                                @if(Auth::user()->usuario->alerta)
                                    @if( Auth::user()->usuario->alerta->notificacion!=0)
                                        <span class="badge">
                                           {{ Auth::user()->usuario->alerta->notificacion}}
                                        </span>       
                                    @endif

                                @endif
                        
                        </a>
                    </li>
                    <li class="{{ $current['agenda']}}">
                        <a href="{{ route('miagenda') }}" >
                            <span class="icon-address-book-2"></span> 
                            Agenda 
                            
                        </a>
                    </li>
                    <li class="divider"></li>
                        <li>
                            <a href="{{ route('salir')  }}" >
                                <span class="icon-switch"></span> 
                                    Salir del sistema
                            </a>
                        </li>
                </ul>
        </li>
    @endif
    </ul>
</div><!-- fin .navbar-collapse -->