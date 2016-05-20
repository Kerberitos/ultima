@if($anuncio->estado_id==3)

		<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
			<p class="alert alert-danger alert-size">Este anuncio fue bloqueado por un administrador</p>
		</div>

		<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
		<div class="row">
				<div class="col-xs-12">
		            <div>
				        <div class="row">
						    <div class="col-xs-12 col-sm-3 col-md-2">
						        <label>Fecha de bloqueo:</label>
							</div>
							 
							<div class="col-xs-12 col-sm-8 col-md-4">
						    	<p >  
							    	{{$ultimaHistoria->created_at->format('l, j').' de '.$ultimaHistoria->created_at->format('M').' del '.$ultimaHistoria->created_at->format('Y') }}
								</p>
						    </div> 
						</div>
							    
						<div class="row">
						    <div class="col-xs-12 col-sm-3 col-md-2">
						        <label>Política infringida:</label>
						    </div>
							<div class="col-xs-12 col-sm-8 col-md-4">
							    <p >  
							        {{ $ultimaHistoria->politica->descripcion}}
							    </p>
							</div> 
						</div>
						
						<div class="row">
						    <div class="col-xs-12 col-sm-3 col-md-2">
						        <label>Motivo bloqueo:</label>
						    </div>
							<div class="col-xs-12 col-sm-8 col-md-4">
							    <p >  
							        {{ $ultimaHistoria->justificacion}}
							    </p>
							</div> 
						</div>

			        </div>
        		</div>
			</div><!--fin row-->

			</div>


	@endif
