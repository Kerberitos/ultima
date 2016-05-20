<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <div class="noefecto">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#desplegable-admin">

            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
    </div>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-left" id="desplegable-admin">
    <ul class="nav navbar-nav main-menu-admin" id="main-menu">
        <li title="Panel principal de administrador" class="{{ $current['administracion']}}">
            <a href="{{ route('administracion') }}">
                <span class="icon-eye-open"></span>
                    PANEL GENERAL
            </a>
        </li>
        <li title="Tareas administrador" class="{{ $current['tareas'] }}">
            <a href="{{ route('admin.pendientes') }}" >
                <span class="glyphicon glyphicon-time"></span> 
                    TAREAS PENDIENTES
            </a>
        </li>
        <li title="Mensajes de contactanos" class="{{ $current['msmcontactanos'] }}">
            <a href="{{ route('admin.msmcontactanos') }}" >
                <span class=" icon-envelope"></span> 
                    SUGERENCIAS

                    
            </a>
        </li>
        

        @if (Auth::check())
            @if(is_super()) 
                
                <li title="Actividades del sistema" class="{{ $current['sistema']}}">
                    <a href="{{ route('super.system') }}">
                        <span  class=" icon-box"></span> 
                            SISTEMA
                    </a>
                </li>

                <li title="Gestión de usuarios" class="{{ $current['usuarios']}}">
                    <a href="{{ route('super.usuarios') }}">
                        <span  class="icon-users"></span> 
                            USUARIOS
                    </a>
                </li>
            @endif
        @endif

         <li title="Administradores" class="{{ $current['administradores']}}">
            <a href="{{ route('lista.administradores') }}">
                <span  class="icon-accessibility"></span> 
                EQUIPO
            </a>
        </li>

    </ul>
</div><!-- fin .navbar-collapse -->