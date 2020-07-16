@extends('layout.admin')
@section('contenido')
<div class="row">
  <div class="col-xs-12">
    <h3>COBROS</h3>
    
    <div class="container-fluid">
      <h2>Listado de Cobros</h2>
      <form action="/listaAgua/socio" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-4">
                <div class="container">
                  <label for="idSocio">Seleccione Socio</label>
                  <select name="idSocio" id="" class=" selectpicker" data-live-search="true">
                    <option value="0">General</option>
                    @foreach($socio as $soc)
                        <option value="{{$soc->idSocio}}">{{$soc->nombre.' '.$soc->apellidoP.' '.$soc->apellidoM}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                  <button type="submit" class="btn btn-success">Obtener</button>
              </div>  
            </div>
          </div>
      </form>
      <hr>
      <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <span class="input-group-addon">Buscar <i class="fa fa-search"></i> </span>
              <input id="filtrar" type="text" class="form-control" placeholder="Ingresa criterio de Busqueda...">
            </div>
            
         </div>
      </div>
          @if($cobro!=[])
          <table class="table table-striped table-bordered table-condensed table-hover table-responsive">
              <thead>
                <th>Concepto</th>
                <th>Fecha del Cobro</th>
                <th>Mes Correspondiente</th>
                <th>Monto</th>
                <th>Cantidad Consumo</th>
                <th>Nº Medidor</th>
                <th>Socio</th>
                <th></th>
              </thead>
              <tbody class="buscar">
                @foreach ($cobro as $cb)
                <tr>
                  <td>{{$cb->concepto}}</td>
                  <td>{{$cb->fechaCobro}}</td>
                  <td>{{$cb->mes}}</td>
                  <td>{{$cb->monto}}</td>
                  <td>{{$cb->cantidadConsumo}}</td>
                  <td>{{$cb->medidor}}</td>
                  <td>{{$cb->nombreSocio.' '.$cb->apellidoP.' '.$cb->apellidoM}}</td>
                </tr>
                @endforeach
              </tbody>
          </table>
    
    
          @else
          <div class="container" style="background-color: darkgrey;text-align: center;margin-top: 2em;">
              <div class="row">
                  <p>No hay resultados</p>
                </div>  
          </div>
          @endif
        </div>

      </div>
    
    </div>
@endsection
