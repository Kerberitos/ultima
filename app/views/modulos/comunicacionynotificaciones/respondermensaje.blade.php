@extends('layout')
@section('contenido')
	
	<div class="contenedor-interno">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 espacio-superior-peq">
				<p class="texto-negrita linea-inferior">Mensaje enviado por un </p>
				
				<div class="row linea-inferior">
				      <div class="col-xs-12 col-sm-3">
				          {{ Form::label('recibido','RECIBIDO:') }}
				      </div>
				 
				      <div class="col-xs-12 col-sm-7">
					        <p >  
					          
					        </p>
				      </div> 
			    </div>
				<div class="row linea-inferior">
				      <div class="col-xs-12 col-sm-3">
				          {{ Form::label('remitente','REMITENTE:') }}
				      </div>
				 
				      <div class="col-xs-12 col-sm-7">
					        <p >  
					          
					        </p>
				      </div> 
			    </div>
			</div>

			<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 cuadro-mensaje">
				<p></p>
			</div>

			
			
			
			<div class="col-xs-12  col-sm-offset-4 col-sm-4 col-md-offset-3 col-md-6 pie espacio-superior-peq">
				
				<a href="{{route('respondermensaje')}}" title="" class="btn btn-success col-xs-12"><i class="g icon-pencil-2" aria-hidden="true" ></i> Responder</a>	


				<a href="{{route('mismensajes')}}" class="btn btn-primary col-xs-12 boton-cancelar">
        		<i class="glyphicon glyphicon-chevron-left">
        		</i>
        			Regresar
      			</a>
			</div>



		</div>
	</div>
@stop
