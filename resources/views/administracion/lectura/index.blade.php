@extends('layout.admin')
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3>Listado de Socio con Lecturas</h3>
      <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <span class="input-group-addon">Buscar <i class="fa fa-search"></i> </span>
              <input id="filtrar" type="text" class="form-control" placeholder="Ingresa criterio de Busqueda...">
            </div>
            <div> 
            </div>
      {{-- @include('administracion.lectura.search') --}}
    </div>
  </div>
  <div class="row">
      <div class="col-xs-12">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Nombre Socio</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Codigo Medidor</th>
                <th>Carnet Identidad</th>
                <th>Ultimo mes Lecturado</th>
              </thead>
              <tbody class="buscar">

                @foreach ($socio as $soc)
                <tr>
                  <td>{{$soc->nombre}}</td>
                  <td>{{$soc->apellidoP}}</td>
                  <td>{{$soc->apellidoM}}</td>
                  <td>{{$soc->codigo}}</td>
                  <td>{{$soc->carnetIdentidad}}</td>
                  <td>
                    <a href="{{URL::action('LecturaController@show', $soc->idMedidor)}}" class="btn btn-info">Ver Lecturas</a>
                    <a href="{{url('administracion/lectura/create')}}/{{$soc->idMedidor}}" class="btn btn-success">Registrar Lectura</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              </table>
            </div>
        {{$socio->render()}}
      </div>
  </div>
@endsection
