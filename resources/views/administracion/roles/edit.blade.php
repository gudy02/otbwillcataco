@extends('layout.admin')
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3>Editar Rol</h3>
      @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {!!Form::Open(array('action'=>array('RolController@update',$rol->idRol),'method'=>'PUT'))!!}
      {{Form::token()}}
          <div class="col-xs-6">
            <div class="form-group">
              <label for="nombre">Nombre Rol:</label>
              <input type="text" name="nombre" class="form-control" placeholder="Nombre del Rol" value="{{$rol->nombre}}">
            </div>
          </div>
          <div class="col-xs-12">
            <button type="submit" name="button" class="btn btn-primary">Guardar Cambios</button>
            <button type="reset" name="button" class="btn btn-danger">Cancelar</button>
          </div>
      {{Form::Close()}}
    </div>
  </div>
@endsection
