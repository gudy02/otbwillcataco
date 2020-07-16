@extends('layout.admin')
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3>Listado de Roles <a href="roles/create" class="btn btn-primary">Registrar Socio </a>  </h3>
      {{-- @include('administracion.roles.search') --}}
      <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <span class="input-group-addon">Buscar</span>
              <input id="filtrar" type="text" class="form-control" placeholder="Ingresa criterio de Busqueda...">
            </div>
            <div> 
            </div>
    </div>
  </div>
  <div class="row">
      <div class="col-xs-12">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Rol</th>
              </thead>
              <tbody class="buscar">

                @foreach ($rols as $rol)
                <tr>
                  <td>{{$rol->nombre}}</td>
                  
                  <td>
                    <a href="{{URL::action('RolController@edit', $rol->idRol)}}" class="btn btn-info">Editar</a>
                    <a href="" data-target="#modal-delete-{{$rol->idRol}}" data-toggle="modal"><button type="button" class="btn btn-danger">Eliminar</button></a>
                  </td>
                </tr>
                @include('administracion.roles.modal')
                @endforeach
              </tbody>
          </table>
        </div>
        {{$rols->render()}}
      </div>
  </div>
@endsection
