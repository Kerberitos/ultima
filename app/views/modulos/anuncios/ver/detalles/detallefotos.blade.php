<div class="flexslider margen-ver-fotos">
    <ul class="slides">
        @if(!$anuncio->foto1=="")
            <li >
              <img src="{{ $anuncio->foto1 }}" />
            </li>
        
        @else    
             <li >
              <img src="{{ asset('assets/images/vistasinfoto.png')}}" class="img-responsive" alt="">
            </li>
        @endif
        @if(!$anuncio->foto2=="")
            <li >
              <img src="{{ $anuncio->foto2 }}" />
            </li>
        @endif
        
        @if(!$anuncio->foto3=="")
            <li >
              <img src="{{ $anuncio->foto3 }}" />
            </li>
        @endif
        @if(!$anuncio->foto4=="")
            <li >
              <img src="{{ $anuncio->foto4 }}" />
            </li>
        @endif
      
      
  </ul>
</div>
