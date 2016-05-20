@if (Session::has('cambio_correcto'))
   <p class="alert alert-success">{{ Session::get('cambio_correcto') }}</p>
@endif

<div>
  <div >
    <p class="subtitulo-profile">Información general</p>
  </div>
  
  <div>
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-4">
          {{ Form::label('nombres','Nombre y Apellido:') }}
      </div>
 
      <div class="col-xs-12 col-sm-8">
        <p >  
          {{ $usuario->nombres }}
        </p>
      </div> 
    </div>
    
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-4">
        {{ Form::label('genero','Género:') }}
      </div>
        
      <div class="col-xs-12 col-sm-8">
        <p>  
          {{ $usuario->genero_title }}
        </p>
      </div>
    </div>
        
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-4">
        {{ Form::label('telefono','Teléfono:') }}
      </div>
      <div class="col-xs-12 col-sm-8">
          <p>  
            @if(empty($usuario->telefono))
              {{ 'Número no asignado' }}
            @else
              {{ $usuario->telefono }}
            @endif
          </p>
      </div>
    </div>
       
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-4">
        {{ Form::label('celular','Celular:') }}
      </div>
        
      <div class="col-xs-12 col-sm-8">
        <p>  
          @if(empty( $usuario->celular))
            {{ 'Número no asignado' }}
          @else
            {{  $usuario->celular }}
          @endif
        </p>
      </div>
    </div>
    
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-4">
        {{ Form::label('compania','Empresa telefónica:') }}
      </div>
      <div class="col-xs-12 col-sm-8">
        <p>  
          @if(empty($usuario->compania->nombre))
            {{ 'Empresa no asignada' }}
          @else
            {{ $usuario->compania->nombre }}
          @endif
        </p>
      </div>
    </div>
  </div><!--fin panel body-->

  <div>
    <div class="row">
      <div class="col-xs-12 col-sm-4">
        <a href="{{ route('ediciondatos', [$usuario->slug]) }}" class="btn btn-sm col-xs-12 btn-warning ">
          <i class="glyphicon glyphicon-edit">
          </i>
          Modificar datos
        </a>
      </div>
    </div>    
  </div>
</div>