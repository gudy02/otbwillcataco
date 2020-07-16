@extends('layout.admin')
@section('css')
<link rel="stylesheet" href="{{asset('css/imprimir.css')}}">
@endsection
@section('contenido')
@php
    $mes=substr($fecha,5,2);
    $dia=substr($fecha,8,2);
    $year=substr($fecha,0,4);
    $montoT=0;
@endphp

<div style="border: #2966b6 double 1em;margin: 2%;padding: 2%">
    <div class="row" style="text-align: center">
        <div class="col-xs-4" >
            <img src="{{asset('img/agua.jpg')}}" height="100px" width="300px" class="img-thumbnail" alt="" srcset="">
        </div>
        <div class="col-xs-4">
                <h1>SISTEMA DE AGUA WILKATACU</h1>
                <em>cbba-Colcapirhua-{{$year}}</em>
                <h2><b>RECIBO POR ACCION</b></h2>
                <div class="table-responsive">
                     
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="bg-primary "  >
                            
                            <th style="text-align:center">Dia</th>
                            <th style="text-align:center">Mes</th>
                            <th style="text-align:center">Año</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$dia}}</td>
                                <td>{{$mes}}</td>
                                <td>{{$year}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

        </div>
        <div class="col-xs-2"></div>
        <div class="col-xs-2">
                <label for="bs">Bs.-</label>
                <input type="text" name="bs" class="total form-control" value="{{$socio->accion}}" style="text-align: center" disabled >
        </div>
    </div>
    
        <div class="row">
          <div class="container">
            <div class="col-xs-12">
                <div class="container">
                    <label for="nombre" class="titulo">Hemos recibido de: </label>
                    {{$socio->nombre.' '.$socio->apellidoP.' '.$socio->apellidoM}}
                </div>
                <div class="container">
                        <label for="suma" class="titulo">La suma de: </label>
                        {{$socio->accion}} Bs.-      
                </div>
                <div class="container">
                        <label for="concepto" class="titulo">Concepto de: </label>
                        {{$socio->concepto}}      
                </div>
                <div class="container">
                       <!--  <label for="monto" class="titulo">A cuenta de: </label> 
                        {{$socio->accion}} Bs.-       -->
                        <label for="saldo" class="titulo" style="margin-left: 1em">Con saldo de: </label> 
                        {{3500-$socio->accion}} Bs.-      
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-2" style="border-top: black solid 1px;text-align: center;margin-top: 5%">
                           Reistrado por: {{Auth::user()->name}}
                        </div>
                        <div class="col-xs-1"></div>
                        <div class="col-xs-2" style="border-top: black solid 1px;text-align: center;margin-top: 5%">
                           Socio: {{$socio->nombre}} {{$socio->apellidoP}}
                        </div>
                    </div> 
                </div>
                <a  onclick="window.print();" href="#"  class="btn btn-success">IMPRIMIR RECIBO</a>
        
              </div>
          </div>
      </div>
</div>  
@endsection
{{-- <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Nombre</th>
              <th>Apellido Paterno</th>
              <th>Apellido Materno</th>
              <th>Carnet Identidad</th>
              <th>Fecha Registro</th>
              <th>Monto Accion</th>
              <th>Observacion</th>
            </thead>
            <tbody class="buscar">
    
              @foreach ($socio as $soc)
              <tr>
                <td>{{$soc->nombre}}</td>
                <td>{{$soc->apellidoP}}</td>
                <td>{{$soc->apellidoM}}</td>
                <td>{{$soc->carnetIdentidad}}</td>
                <td>
                    {{$soc->fechaReg}}
                </td>
                <td>{{$soc->accion}}</td>
                <td>{{$soc->concepto}} </td>
              </tr>
              @endforeach
            </tbody>
        </table>
      </div> --}}