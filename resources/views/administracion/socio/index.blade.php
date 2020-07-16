@extends('layout.admin')
@section('contenido')
  <div class="row">
    <div class="col-xs-12">

      <!--SE quito el boton de Registrar Socio-->
      <!--<a href="socio/create"><button type="button" name="button" class="btn btn-primary">Registrar Socio</button> </a>  -->

      <h3>Listado de Socios</h3>
       <b style="float: right;">Socios Registrados:{{$cantidad}}</b> 
      <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <span class="input-group-addon">Buscar <i class="fa fa-search"></i> </span>
              <input id="filtrar" type="text" class="form-control" placeholder="Ingresa criterio de Busqueda...">
            </div>
            <div> 
            </div>
      {{-- @include('administracion.socio.search') --}}
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
                <th>Nº Medidor</th>
                <th>Foto</th>
                <th>Dirección</th>
              </thead>
              <tbody class="buscar">

                @foreach ($socio as $soc)
                <tr>
                  <td>{{$soc->nombre}}</td>
                  <td>{{$soc->apellidoP}}</td>
                  <td>{{$soc->apellidoM}}</td>
                  <td>{{$soc->carnetIdentidad}}</td>
                  <td>{{$soc->codigo}}</td>
                  <td>
                    <img src="{{asset('imagenes/socio/'.$soc->foto)}}" alt="{{$soc->nombre}} no se encontro" height="100px" width="100px" class="img-thumbnail">
                  </td>
                  <td>{{$soc->direccion}}</td>
                  <td>
                    <!--<a href="{{url('editar')}}/{{$soc->idSocio}}/{{$soc->idCobroAccion}}" class="btn btn-info">Editar</a>-->
                    <a href="{{URL::action('SocioController@edit', $soc->idSocio)}}" class="btn btn-info">Editar</a>
                    <!-- <a href="" data-target="#modal-delete-{{$soc->idSocio}}" data-toggle="modal"><button type="button" class="btn btn-danger">Eliminar</button></a> -->
                  </td>
                </tr>
                @include('administracion.socio.modal')
                @endforeach
              </tbody>
          </table>
        </div>
       {{$socio->render()}}

      </div>
  </div>
@endsection
