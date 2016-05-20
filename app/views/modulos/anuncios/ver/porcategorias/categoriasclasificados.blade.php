@extends('layout')
@section('contenido')
<div class="contenedor-interno">
	<div class="text-center">
	    <h3>Categorías de clasificados</h3>
	</div>
	

	<div class="row">
		<div class="col-xs-12  col-sm-12 col-md-12 cabeza">
			<ol class="breadcrumb">
			  <li><a href="{{ route('main') }}">Inicio</a></li>
			  <li><a href="{{ route('verclasificados') }}">Clasificados</a></li>
			  <li class="active">Categorías</li>
			</ol>

		
		</div><!--fin cabeza-->		
	  @foreach ($categorias as $categoria)
	  	 <div class=" col-xs-12 col-md-6">
           
            <div class="blockquote-box blockquote-info clearfix">
                <div class="square pull-left">
                    <span class="{{$categoria->icono}} glyphicon-lg"></span>
                </div>
                <h4 class="enlace-categoria">
                	<a href="{{ route('clasificados.categoria.n',[$categoria->id]) }}" title="">{{$categoria->categoria}}
					</a>
                	
                </h4>
	                <p class="enlacessubcategorias">
		                @foreach ($categoria->subcategorias as $subcategoria)
			            	<a href="{{ route('clasificados.subcategoria.n',[ $categoria->id, $subcategoria->id ]) }}" title="">{{$subcategoria->subcategoria}} </a>  -  

			                	
		                @endforeach
	                </p>
            </div>
            
        </div>





	  @endforeach
	</div><!--fin row-->
</div>
@stop