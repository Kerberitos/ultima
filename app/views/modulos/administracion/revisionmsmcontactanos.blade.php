@extends('layout')
@section('contenido')
	
	<div class="contenedor-interno">


		<div class="row">
			<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 espacio-superior-peq">
				@if(Session::has('status_ok'))
					<p class="alert alert-success">{{Session::get('status_ok')}}</p>
				@endif
				@if(Session::has('status_error'))
					<p class="alert alert-danger">{{Session::get('status_error')}}</p>
				@endif
				<p class="texto-negrita linea-inferior">Detalle de mensaje</p>
				
				<div class="row linea-inferior">
				      <div class="col-xs-12 col-sm-3">
				          {{ Form::label('recibido','RECIBIDO:') }}
				      </div>
				 
				      <div class="col-xs-12 col-sm-7">
					        <p >  
					          {{$mensaje->created_at->format('l, j M Y H:i a')}} 
					        </p>
				      </div> 
			    </div>
				<div class="row linea-inferior">
				      <div class="col-xs-12 col-sm-3">
				          {{ Form::label('remitente','REMITENTE:') }}
				      </div>
				 
				      	<div class="col-xs-12 col-sm-7">
				      		<p >
					        {{ $mensaje->nombres }} ( {{$mensaje->correo}} )
							</p>
				      </div> 
			    </div>
			    <div class="row linea-inferior">
				      <div class="col-xs-12 col-sm-3">
				          {{ Form::label('motivo','MOTIVO:') }}
				      </div>
				 
				      	<div class="col-xs-12 col-sm-7">
				      		<p >
					        {{ $mensaje->motivo_title }}
							</p>
				      </div> 
			    </div>
			    <div class="row cuadro-mensaje">
					<p> <span class="texto-negro texto-negrita">
						{{$mensaje->nombres }} escribió:
						</span>
					</p>

					<p>	{{$mensaje->mensaje}}</p>
				</div>
			</div>



			

			
		
			@if(Session::has('status_ok'))
				<p class="alert alert-success">{{Session::get('status_ok')}}</p>
			@endif

			<div class="col-xs-12  col-sm-offset-4 col-sm-4 ">
			<a href="{{ route('admin.verificar.cuenta', [$mensaje->id]) }}" class="btn col-xs-12 btn-warning btn-sm btn-separado espacio-superior-min" id="btn-mostrarespondermensajecontactanos" title="Verificar cuenta">Verificar cuenta</a>	
			</div>

			<div class="col-xs-12  col-sm-offset-4 col-sm-4 ">
			<a href="" data-toggle="modal" data-target="#eliminarmensajecontactanos" title="Eliminar mensaje de contáctanos" class=" btn col-xs-12  btn-danger btn-sm btn-separado espacio-superior-min" id="btn-eliminarmensajecontactanos" title="">Eliminar mensaje</a>
			</div>
	
		
		

		 <div class="col-xs-12 espacio-superior-peq">
          <div class="row">
              <a href="{{route('admin.msmcontactanos')}}" class="btn btn-primary col-xs-12 col-sm-offset-4 col-sm-4 ">
              <i class="icon-circle-arrow-left">
              </i>
                Ir a sugerencias
            </a>
          </div>

        
    </div>



		</div>
		@include('modales.modaleliminarmensajecontactanos')
	</div>
@stop
