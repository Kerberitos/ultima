 <div class="modal fade bs-example-modal-sm" id="activarcuentausuario" tabindex="-1" role="dialog" aria-labelledby="bloquearanuncio" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="panel panel-success">

        <div class="panel-heading">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          
          <h4 class="panel-title custom_align" id="Heading">
            <span class="glyphicon glyphicon-ok">
            </span> 
                Activar cuenta de usuario
          </h4>
        </div>
        
        <div class="modal-body">
         
          <div>
              ¿Realmente desea activar la cuenta de este usuario? 
          </div>
         
        </div>
        
        <div class="panel-footer">
          <a href="{{ route('admin.activarcuentausuario', [$usuario->id])  }}" type="button" class="btn btn-success" >
            </span> 
              Activar
          </a>
          <button type="button" class="btn btn-default" data-dismiss="modal">
              
              
                No
          </button>
        </div>
      </div><!-- /.modal-content --> 
      
    </div>
  </div>