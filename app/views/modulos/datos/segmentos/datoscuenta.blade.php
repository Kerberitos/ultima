
<div>
  <div >
    <p class="subtitulo-profile">Información de la cuenta</p>
  </div>
  
  <div >
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-4">
          {{ Form::label('correo','Correo electrónico:') }}
      </div>
 
      <div class="col-xs-12 col-sm-8">
        <p class="lbl-detalle-correo">  
          {{  $cuenta->correo }}
        </p>
      </div> 
    </div>
    
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-4">
          {{ Form::label('estado','Estado:') }}
      </div>
        
        <div class="col-xs-12 col-sm-8">
          <p>  
            {{ $cuenta->estado->estado }}
          </p>
        </div>
        
    </div>
        
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-4">
          {{ Form::label('creacion','Usuario desde:') }}
      </div>
      <div class="col-xs-12 col-sm-8">
          
          <p>
            {{$cuenta->created_at->format('l, j').' de '.$cuenta->created_at->format('M').' del '.$cuenta->created_at->format('Y') }}
            
          </p>
      </div>
    </div>
    
  </div><!--fin panel body-->

  <div>
    <div class="row">
      <div class="col-xs-12 col-sm-4">
        @if(!empty(\Auth::user()->correo))
          <a href="{{ route('edicioncuenta', [$usuario->slug]) }}" class="btn btn-warning btn-sm col-xs-12 btn-separado">
            <i class="glyphicon glyphicon-edit hidden-xs">
            </i>
            Modificar correo
          </a>
        @else
          <a href="{{ route('completarcorreo') }}" class="btn btn-success btn-sm col-xs-12 btn-separado">
            <i class="glyphicon glyphicon-edit hidden-xs">
            </i>
            Ingresar correo
          </a>
        @endif
      </div>

      @if(!empty(\Auth::user()->correo))
        <div class="col-xs-12 col-sm-4">
            <a href="{{ route('cambiarpassword') }}" class="btn btn-info btn-sm col-xs-12 btn-separado">
              <i class="icon-key hidden-xs">
              </i>
              Modificar contraseña
            </a>
        </div>
        
        <div class="col-xs-12 col-sm-4">
            <a href="{{ route('bajacuenta', [$usuario->slug]) }}" data-toggle="tooltip" data-placement="top"  class="btn col-xs-12 btn-danger btn-sm btn-separado" title="Eliminar la cuenta">
              <i class="glyphicon glyphicon-remove hidden-xs">
              </i>
              Eliminar mi cuenta
            </a>
        </div>
      @endif  
    </div>  
  </div>
</div>