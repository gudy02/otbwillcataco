@extends('layout.admin')
@section('contenido')
<div class="row">
  <div class="col-xs-12">
    <h3>COBROS</h3>
    @if (count($errors)>0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="container">
        <h2>Listado de Multas</h2>
        <form action="/listaMulta/socio" method="post">
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
          @if($multa!=[])
          <table class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Motivo</th>
                <th>Monto</th>
                <th>Fecha Multa</th>
                <th>Tipo Multa</th>
                <th>Fecha Pago</th>
                <th>Socio</th>
              </thead>
              <tbody class="buscar">

                @foreach ($multa as $mul)
                <tr>
                  <td>{{$mul->concepto}}</td>
                  <td>{{$mul->monto}}</td>
                  <td>{{$mul->fechaMulta}}</td>
                  <td>{{$mul->tipoMulta}}</td>
                  <td>{{$mul->fechaPago}}</td>
                  <td>{{$mul->nombreSocio.' '.$mul->apellidoP.' '.$mul->apellidoM}}</td>
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
  </div>
</div>
@endsection
