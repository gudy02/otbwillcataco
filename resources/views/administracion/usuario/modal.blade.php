<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$usu->idUsuario}}">
{{Form::Open(array('action'=>array('UsuarioController@destroy',$usu->idUsuario),'method'=>'delete'))}}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" name="button" class="close" data-dismiss='modal' aria-label="close">
          <span aria-hidden="true"> <i class="fa fa-close"></i></span>
        </button>
        <h4 class="modal-title">Eliminar Usuario</h4>
      </div>
      <div class="modal-body">
        <p>Estas seguro de eliminar al Usuario <b>{{$usu->nombre}} {{ $usu->apellidoP}} {{$usu->apellidoM}}</b> </p>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-default" data-dismiss='modal'>Cerrar</button>
        <button type="submit"  class="btn btn-danger">Confirmar</button>
      </div>
    </div>
  </div>
{{Form::Close()}}
</div>
