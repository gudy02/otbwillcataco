@extends('layout.admin')
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3>Listada de Lecturas del Socio {{$socio->nombre.' '.$socio->apellidoP.' '.$socio->apellidoM}} con Medidor: {{$medidor->codigo}}</h3>

    </div>
  </div>
  <div class="row">
      <div class="col-xs-12">

          @foreach ($lectura as $lec)
            <div class="card text-white bg-dark mb-3" style="width: 100%;">
              <h1 class="card-img-top">{{$lec->mes.' '.$lec->year}}</h1>
              <div class="card-body">
                <h5 class="card-title">{{$lec->fechaRegistro}}</h5>
                <p class="card-text">Cantidad Cosumida: <b>{{$lec->cantidadConsumo}}</b> metros Cubicos</p>
                  <p> Total a Pagar: <b>{{$lec->totalPagar}}</b> Bs.-</p>
                <p>Registrado por <b>{{$lec->name. ' '. $lec->apellidoP}}</b></p>
              </div>
            </div>
          @endforeach

      </div>
  </div>
@endsection
