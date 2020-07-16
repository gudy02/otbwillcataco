@extends('layout.admin')

@section('scripts')
<script>
  $(document).ready(function(){

  //PARA CREAR OTRO ROL***

  //   $('#nuevoRol').hide();
  //   $('select#rol').on('change',function(){
  //     if ($('#rol').val()=='otro') {
  //       $('#nuevoRol').show(1000);
  //
  //     } else {
  //       $('#nuevoRol').hide(1000);
  //
  //     }
  //   })
  });
</script>
@endsection

@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3>Nuevo Usuario</h3>

      @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {!!Form::open(array('url' =>'administracion/usuario' ,'method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
      {{Form::token()}}
          <div class="col-xs-6">
            <div class="form-group">
              <label for="nombre">Nombre:</label>
              <input type="text" name="nombre" class="form-control" placeholder="Nombre del Usuario" value="{{old('nombre')}}">
            </div>
            <div class="form-group">
              <label for="apellidoP">Apellido Paterno</label>
              <input type="text" name="apellidoP" class="form-control" placeholder="Apellido Paterno" value="{{old('apellidoP')}}">
            </div>
            <div class="form-group">
              <label for="apellidoM">Apellido Materno</label>
            </div>
            <input type="text" name="apellidoM" class="form-control" placeholder="Apellido Materno" value="{{old('apellidoM')}}">
            <div class="form-group">
              <label for="carnetIdentidad">Carnet de Indentidad</label>
              <input type="text" name="carnetIdentidad" class="form-control" placeholder="Numero de Carnet de Identidad" value="{{old('carnetIdentidad')}}">
            </div>
            <div class="form-group">
              <label for="imagen">Imagen</label>
              <input type="file" name="imagen" class="form-control" >
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="login">Login</label>
              <input type="text" name="login" class="form-control" placeholder="Nombre de Usuario" value="{{old('login')}}">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Password del usuario" value="{{old('password')}}">
            </div>
            <div class="form-group">
              <label for="confirmarPassword">Confirmar Password</label>
              <input type="password" name="confirmarPassword" class="form-control" placeholder="Confirmar Password del usuario" value="{{old('password2')}}">
            </div>
            <div class="form-group">
              <label for="fecha">Fecha Registro</label>
              <input type="text" value="{{$fecha}}" name="fecha" class="form-control" disabled >
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <select id="rol" name="rol" class="form-control" >
                @foreach($rols as $rol)
                    <option value="{{$rol->idRol}}">{{$rol->nombre}}</option>
                @endforeach
                <!--<option value="otro">Otro Rol...</option>--> <!--Nuevo Rol-->
                <option value="otro">Otro Rol...sdadad</option> <!--Nuevo Rol-->
                </select>
            </div>
            <div class="form-group" id="nuevoRol">
              <label for="nuevoRol">Nuevo Rol</label>
              <input type="text"  name="nuevoRol" class="form-control" placeholder="Agregar el nuevo rol" value="{{old('nuevoRol')}}">
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
