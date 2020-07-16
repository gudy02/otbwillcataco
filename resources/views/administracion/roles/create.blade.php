@extends('layout.admin')
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3>Nuevo Rol</h3>
      @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {!!Form::open(array('url' =>'administracion/roles' ,'method'=>'POST','autocomplete'=>'off'))!!}
      {{Form::token()}}
          <div class="col-xs-6">
            <div class="form-group">
              <label for="nombre">Nombre Rol:</label>
              <input type="text" name="nombre" class="form-control" placeholder="Nombre del Rol" value="{{old('nombre')}}">
            </div>
          </div>
          <div class="col-xs-12">
            <button type="submit" name="button" class="btn btn-primary">Registrar</button>
            <button type="reset" name="button" class="btn btn-danger">Cancelar</button>
          </div>
      {{Form::Close()}}
    </div>
  </div>
@endsection
