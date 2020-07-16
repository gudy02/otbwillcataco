@extends('layout.admin')
@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <h3>Listado de Aportes</h3>
            <b style="float: right;">Aportes Registrados:{{count($aportes)}}</b>
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
                            <th>Monto</th>
                            <th>Fecha</th>
                            </thead>
                            <tbody class="buscar">

                            @foreach ($aportes as $soc)
                                <tr>
                                    <td>{{$soc->nombre}}</td>
                                    <td>{{$soc->apellidoP}}</td>
                                    <td>{{$soc->apellidoM}}</td>
                                    <td>{{$soc->carnetIdentidad}}</td>
                                    <td>{{$soc->codigo}}</td>
                                    <td>{{$soc->monto}}</td>
                                    <td>{{$soc->fecha_cobro}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
@endsection
