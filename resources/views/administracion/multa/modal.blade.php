<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$mul->idMulta}}">
{{Form::Open(array('action'=>array('MultaController@destroy',$mul->idMulta),'method'=>'delete'))}}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" name="button" class="close" data-dismiss='modal' aria-label="close">
          <span aria-hidden="true"> <i class="fa fa-close"></i></span>
        </button>
        <h4 class="modal-title">Eliminar Multa</h4>
      </div>
      <div class="modal-body">
        <p>Esta seguro de eliminar la multa <b>{{$mul->nombre}}</b> </p>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-default" data-dismiss='modal'>Cerrar</button>
        <button type="submit"  class="btn btn-danger">Confirmar</button>
      </div>
    </div>
  </div>
{{Form::Close()}}
</div>
