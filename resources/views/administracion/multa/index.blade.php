@extends('layout.admin')
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <!-- <a href="multa/create"><button type="button" name="button" class="btn btn-primary">Registrar Multa</button> </a>  -->
      <h3>Listado de Multas</h3>
      <div class="row">
        <div class="col-md-12">
          <div class="input-group">
            <span class="input-group-addon">Buscar <i class="fa fa-search"></i> </span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingresa criterio de Busqueda...">
          </div>
          <div> 
          </div>
      {{-- @include('administracion.multa.search') --}}
    </div>
  </div>
  <div class="row">
      <div class="col-xs-12">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Nombre Multa</th>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Socio Multado</th>
                <th>Fecha Multa</th>
                {{-- <th>Registrado por</th> --}}
                <th>Pagado</th>
              </thead>
              <tbody class="buscar">

                @foreach ($multa as $mul)
                
                <tr>
                  <td>{{$mul->nombre}}</td>
                  <td>{{$mul->concepto}}</td>
                  <td>{{$mul->monto}}</td>
                  <td>{{$mul->NombreSocio}}</td>
                  <td>{{$mul->fechaMulta}}</td>
                  {{-- <td>{{$mul->NombreUsuario}}</td> --}}
                  <td>{{$mul->pagado}}</td>
                  <td>
                    <a href="{{URL::action('MultaController@edit', $mul->idMulta)}}" class="btn btn-info">Editar</a>
                    {{-- <a href="" data-target="#modal-delete-{{$mul->idMulta}}" data-toggle="modal"><button type="button" class="btn btn-danger">Eliminar</button></a> --}}
                  </td>
                </tr>
                @include('administracion.multa.modal')
                @endforeach
              </tbody>
              </table>
        </div>
        {{$multa->render()}}
      </div>
  </div>
@endsection
