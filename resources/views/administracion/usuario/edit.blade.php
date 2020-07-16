@extends('layout.admin')
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3>Editar Usuario</h3>
      @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {!!Form::model($usuario,['method'=>'PATCH','route'=>['administracion.usuario.update',$usuario->idUsuario],'files'=>'true'])!!}
      {{Form::token()}}
          <div class="col-xs-6">
            <div class="form-group">
              <label for="nombre">Nombre:</label>
              <input type="text" name="nombre" class="form-control" placeholder="Nombre del usuario" value="{{$usuario->nombre}}">
            </div>
            <div class="form-group">
              <label for="apellidoP">Apellido Paterno</label>
              <input type="text" name="apellidoP" class="form-control" placeholder="Apellido Paterno" value="{{$usuario->apellidoP}}">
            </div>
            <div class="form-group">
              <label for="apellidoM">Apellido Materno</label>
            </div>
            <input type="text" name="apellidoM" class="form-control" placeholder="Apellido Materno" value="{{$usuario->apellidoM}}">
            <div class="form-group">
              <label for="carnetIdentidad">Carnet de Indentidad</label>
              <input type="text" name="carnetIdentidad" class="form-control" placeholder="Numero de Carnet de Identidad" value="{{$usuario->carnetIdentidad}}">
            </div>
            <div class="form-group">
              <label for="imagen">Imagen</label> <br>
              <img  src="{{asset('imagenes/usuario/'.$usuario->foto)}}" alt="no se encontro la imagen" height="100px" width="100px" class="img-thumbnail"> <br>
              <label for="fotoNueva">Si desea modificar la fotografia escoja otra foto:</label>
              <input type="file" name="fotoNueva" class="form-control" >
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="login">Login</label>
              <input type="text" name="login" class="form-control" placeholder="Nombre de Usuario" value="{{$usuario->usuario}}">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Password del usuario" value="{{$usuario->password}}">
            </div>
            <div class="form-group">
              <label for="confirmarPassword">Password</label>
              <input type="password" name="confirmarPassword" class="form-control" placeholder="Password del usuario" value="{{$usuario->password}}">
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <select name="rol" >
                @foreach($rols as $rol)
                  @if($usuario->idRol==$rol->idRol)
                      <option value="{{$rol->idRol}}" selected>{{$rol->nombre}}</option>
                  @else
                      <option value="{{$rol->idRol}}">{{$rol->nombre}}</option>
                  @endif
                @endforeach
                </select>
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
