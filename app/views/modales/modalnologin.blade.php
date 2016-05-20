<div class="modal fade" id="nologin" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header modal-header-app">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Ingrese o registrese</h4>
	         
	      </div>
	      <div class="modal-body">
	        <p class="texto-justificado">Para crear un anuncio debe tener una cuenta en Miradita Loja e ingresar.</p>           
	        <p class="texto-justificado">Si no tiene una cuenta,entonces registrese.</p>
	      </div>
	      <div class="modal-footer modal-footer-app">
	        <!--button type="button" class="btn btn-default" data-dismiss="modal">Salir</button-->
	        <a href="{{ route('ingreso') }}" class="btn btn-success btn-sm"> Ingresa</a>
	        <a href="{{ route('registro') }}" class="btn btn-info btn-sm"> Registrate</a>
	      </div>
	    </div>
	  </div>
	</div>
</div>

		