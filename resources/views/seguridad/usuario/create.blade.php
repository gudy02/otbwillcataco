@extends('layout.admin')

@section('scripts')
<script>

//***CREAR OTRO USUARII****
  // $(document).ready(function(){
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
  // });
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
      {!!Form::open(array('url' =>'seguridad/usuario' ,'method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
      {{Form::token()}}
          <div class="col-xs-6">

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Nombre</label>
                <input id="name" type="text" class="form-control" placeholder="nombre" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('apellidoP') ? ' has-error' : ''}}">
              <label for="apellidoP">Apellido Paterno</label>
              <input type="text" name="apellidoP" class="form-control" placeholder="Apellido Paterno" value="{{old('apellidoP')}}">
              @if ($errors->has('apellidoP'))
                  <span class="help-block">
                      <strong>{{ $errors->first('apellidoP') }}</strong>
                  </span>
              @endif
            </div>


            <div class="form-group{{ $errors->has('apellidoM') ? ' has-error' : '' }}">
              <label for="apellidoM">Apellido Materno</label>
              <input type="text" name="apellidoM" class="form-control" placeholder="Apellido Materno" value="{{old('apellidoM')}}">
              @if ($errors->has('apellidoM'))
                  <span class="help-block">
                      <strong>{{ $errors->first('apellidoM') }}</strong>
                  </span>
              @endif
          </div>

            <div class="form-group{{ $errors->has('carnetIdentidad') ? ' has-error' : '' }}">
              <label for="carnetIdentidad">Carnet de Indentidad</label>
              <input type="text" name="carnetIdentidad" class="form-control" placeholder="Numero de Carnet de Identidad" value="{{old('carnetIdentidad')}}">
              @if ($errors->has('carnetIdentidad'))
                  <span class="help-block">
                      <strong>{{ $errors->first('carnetIdentidad') }}</strong>
                    @endif
                  </span>
            </div>

            <div class="form-group">
              <label for="imagen">Imagen</label>
              <input type="file" name="imagen" class="form-control" >
            </div>


          </div>
          <div class="col-xs-6">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail</label>
                <input id="email" type="email" placeholder="correo electronico para logueo" class="form-control" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                  <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" >Contraseña</label>
                <input id="password" type="password" placeholder="Contraseña de ingreso" class="form-control" name="password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>


            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" >Confirmar Contraseña</label>

                    <input id="password-confirm" type="password" placeholder="Confirmar Contraseña de ingreso" class="form-control" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
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
                <!---<option value="otro">Otro Rol...</option>--> <!--otro ROL-->
                </select>
            </div>
          <!--  <div class="form-group" id="nuevoRol">
              <label for="nuevoRol">Nuevo Rol</label>
              <input type="text"  name="nuevoRol" class="form-control" placeholder="Agregar el nuevo rol" value="{{old('nuevoRol')}}">
            </div>
          </div>-->
          <div class="col-xs-12">
            <button type="submit" name="button" class="btn btn-primary">Registrar</button>
            <button type="reset" name="button" class="btn btn-danger">Cancelar</button>
          </div>
      {{Form::Close()}}
    </div>
  </div>
@endsection
