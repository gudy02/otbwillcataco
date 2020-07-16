@extends('layout.admin')
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <!--<a href="usuario/create"><button type="button" name="button" class="btn btn-primary">Registrar Usuario</button> </a>
      se quito esto-->
      <h3>Listado de Usuarios</h3>
      <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <span class="input-group-addon">Buscar</span>
              <input id="filtrar" type="text" class="form-control" placeholder="Ingresa criterio de Busqueda...">
            </div>
            <div> 
            </div>
      {{-- @include('seguridad.usuario.search') --}}
    </div>
  </div>
  <div class="row">
      <div class="col-xs-12">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Carnet Identidad</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Rol</th>
              </thead>
              <tbody class="buscar">

                @foreach ($usuario as $usu)
                <tr>
                  <td>{{$usu->name}}</td>
                  <td>{{$usu->apellidoP}}</td>
                  <td>{{$usu->apellidoM}}</td>
                  <td>{{$usu->carnetIdentidad}}</td>
                  <td>{{$usu->email}}</td>
                  <td>
                    <img src="{{asset('imagenes/usuario/'.$usu->foto)}}" alt="{{$usu->name}} no se encontro" height="100px" width="100px" class="img-thumbnail">
                  </td>
                  <td>{{$usu->rol}}</td>
                  <td>
                    <a href="{{URL::action('UsuarioController@edit', $usu->id)}}" class="btn btn-info">Editar</a>
                    <a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal"><button type="button" class="btn btn-danger">Eliminar</button></a>
                  </td>
                </tr>
                @include('seguridad.usuario.modal')
                @endforeach
              </tbody>
              </table>
        </div>
        {{$usuario->render()}}
      </div>
  </div>
@endsection
