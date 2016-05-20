<ul class="nav navbar-nav">
    @if (!Auth::check())
        <li title="Ingreso al sistema">
            <a class="btn btn-xs boton-menu-registro" href="{{ URL::route('registro') }}">
                <span class="icon-user-add">
                </span> 
                    REGÍSTRATE
            </a>
        </li>   
        <li title="Ingreso al sistema">
            <a class="btn btn-xs boton-menu-ingreso" href="{{ URL::route('ingreso') }}">
                <span class="icon-key">
                </span> 
                    INGRESA
            </a>
        </li>   
                                
    @else
        
        @if(!empty(Auth::user()->correo))
            <li title="Crear un anuncio">
                <a class="btn btn-xs boton-menu-crear" href="{{ URL::route('mostrar.pasouno') }}">
                    
                    </span> 
                        CREAR ANUNCIO
                </a>
            </li>  
        
        @else    
            <li title="Crear un anuncio">
                <a class="btn btn-xs boton-menu-crear" data-toggle="modal" data-target="#nocorreo">
                    
                        <span>CREAR ANUNCIO</span>
                </a>

            </li>
        @endif
    @endif
</ul>