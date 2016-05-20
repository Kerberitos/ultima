 <div class="modal fade bs-example-modal-sm" id="modalrechazarsolicitudparaadministrador" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog modal-sm">
    <div class="panel panel-danger">
          <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="panel-title" id="contactLabel"><span class="icon-cancel"></span> Rechazar solicitud</h4>
      </div>
          <div class="modal-body">
       
       <div>Si el usuario que solicitó ser adminsitrador no cumple con las espectativas, usted puede rechazar la solicitud.  ¿Realmente desea rechazar la solicitud para administrador? </div>
       
      </div>
        <div class="modal-footer ">
        <a href="{{route('rechazar.solicitud', [$usuario->id])}}" type="button" class="btn btn-danger btnmodborrarcomentario" > Rechazar</a>
        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal"> No
                </button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
  </div>