<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$rol->idRol}}">
{{Form::Open(array('action'=>array('RolController@destroy',$rol->idRol),'method'=>'delete'))}}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" name="button" class="close" data-dismiss='modal' aria-label="close">
          <span aria-hidden="true"> <i class="fa fa-close"></i></span>
        </button>
        <h4 class="modal-title">Eliminar Rol</h4>
      </div>
      <div class="modal-body">
        <p>Esta seguro de eliminar el Rol <b>{{ $rol->nombre}}</b> </p>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-default" data-dismiss='modal'>Cerrar</button>
        <button type="submit"  class="btn btn-danger">Confirmar</button>
      </div>
    </div>
  </div>
{{Form::Close()}}
</div>
