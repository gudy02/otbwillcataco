@extends('layout.admin')
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3>Editar Socio</h3>
      @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {!!Form::model($socio,['method'=>'PATCH','route'=>['administracion.socio.update',$socio->idSocio],'files'=>'true'])!!}
      {{Form::token()}}
          <div class="col-xs-6">
            <div class="form-group">
              <label for="nombre">Nombre Socio:</label>
              <input type="text" name="nombre" class="form-control" placeholder="Nombre del socio" value="{{$socio->nombre}}">
            </div>
            <div class="form-group">
              <label for="apellidoP">Apellido Paterno</label>
              <input type="text" name="apellidoP" class="form-control" placeholder="Apellido Paterno" value="{{$socio->apellidoP}}">
            </div>
            <div class="form-group">
              <label for="apellidoM">Apellido Materno</label>
            </div>
            <input type="text" name="apellidoM" class="form-control" placeholder="Apellido Materno" value="{{$socio->apellidoM}}">
            <div class="form-group">
              <label for="carnetIdentidad">Carnet de Indentidad</label>
              <input type="text" name="carnetIdentidad" class="form-control" placeholder="Numero de Carnet de Identidad" value="{{$socio->carnetIdentidad}}">
            </div>
            <div class="form-group">
              <label for="imagen">Imagen</label> <br>
              <img  src="{{asset('imagenes/socio/'.$socio->foto)}}" alt="no se encontro la imagen" height="100px" width="100px" class="img-thumbnail"> <br>
              <label for="fotoNueva">Si desea modificar la fotografia escoja otra foto:</label>
              <input type="file" name="fotoNueva" class="form-control" >
            </div>
            <div class="form-group">
              <label for="direccion">Direccion</label>
              <input type="text" name="direccion" class="form-control" placeholder="calle, zona donde vive" value="{{$socio->direccion}}">
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="medidor">Numero de Medidor</label>
              <input type="text" name="medidor" class="form-control" placeholder="Numero de su medidor" value="{{$medidor->codigo}}">
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
