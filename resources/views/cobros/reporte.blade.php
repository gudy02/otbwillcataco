@extends('layout.admin')
@section('contenido')
@php
    $mes=substr($fecha,5,2);
    $dia=substr($fecha,8,2);
    $year=substr($fecha,0,4);
    $montoT=0;
    $cubosT=0;
    $accionT=0;
    $multaT=0;
@endphp
        <div class="row">
           
            <div style="float: right;margin: 1%">
                <label for="bs">Bs.-</label>
                <input type="text" name="bs" class="total" value="" disabled >
            </div>
        </div>

         <div class="container-fluid">
             <div class="row">
                <h1 style="text-align:center"><b>RECIBO</b></h1>
            </div>
            <div class="row">
                <div class="col-xs-4"></div>
                <div class="col-xs-4">

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
                    <div class="col-xs-4"></div>
             </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-sm-6">
                  <b>Codigo:</b> <label for="">{{$medidor->codigo}}</label>  
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 col-sm-6">
                <b>Socio:</b> 
                <label for="">{{$medidor->nombre}} {{$medidor->apellidoP}} 
                    @if($medidor->apellidoM!="No tiene")
                        {{$medidor->apellidoM}}
                    @endif
                </label>
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 col-md-6 col-sm-6">
                  <b>Cantidad Cubos Consumidos:</b> <label for="" class="cubosTotal"></label>  
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 col-md-6 col-sm-6">
                  <b>Cantidad de Multas pagadas:</b> <label for="" class="multaT"></label>  
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="container-fluid">
                    @if($arreglo)

                <h2 class="text-center">Multas Pagadas</h2>
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="bg-primary">
                                
                                <th>Concepto</th>
                                <th>Fecha Multa</th>
                                <th>Fecha Registro</th>
                                <th>Monto</th>
                            </thead>
                            <tbody>
                                
                                @foreach($arreglo as $m)
                                <tr>
                                    <td>{{$m->concepto}}</td>
                                    <td>{{$m->fechaMulta}}</td>
                                    <td>{{$m->fechaRegistro}}</td>
                                   
                                    <td class="monto">{{$m->monto}}</td>
                                    @php
                                            $montoT=$montoT+$m->monto;           
                                            $multaT=$multaT+1;           
                                    @endphp
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                @endif
                @if($lecturas)
                <h2 class="text-center">Meses Pagados</h2>
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="bg-primary">
                                
                                <!-- <th>lectura Anterior</th> -->
                                <!-- <th>lectura Actual</th> -->
                                <th>Mes</th>
                                <th>M3</th>
                                <!-- <th>Fecha Registro</th> -->
                                <th>Monto Pagado</th>
                            </thead>
                            <tbody>
                               
                                @foreach($lecturas as $lec)
                                <tr>
                                    <!-- <td>{{$lec->lecturaAnterior}}</td> -->
                                    <!-- <td>{{$lec->lecturaActual}}</td> -->
                                    <td>{{$lec->mes}}</td>
                                        @php
                                            $montoT=$montoT+$lec->totalPagar;      $cubosT+=$lec->cantidadConsumo;    
                                        @endphp
                                    <!-- <td>{{$lec->fechaRegistro}}</td> -->
                                    <td class="m3">{{$lec->cantidadConsumo}}</td>
                                    <td class="monto">{{$lec->totalPagar}}</td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                @endif
                
                @if($pagoAccion)
                <h2 class="text-center">Monto por Accion Pagado</h2>
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="bg-primary">
                                
                                <th>Fecha Pago</th>
                                <th>Numero de Pago</th>
                                <th>Monto</th>
                            </thead>
                            <tbody>
                                
                                @foreach($pagoAccion as $pa)
                                @endforeach
                                    <tr>
                                        <td>{{$pa->fechaPago}}</td>
                                        <td>{{$pa->numeroPago}}</td>
                                            @php
                                                $montoT=$montoT+$pa->monto;           
                                                $accionT++;           
                                            @endphp
                                        <td class="monto">{{$pa->monto}}</td>
                                    </tr>
                                
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>

                @endif
                
               
        </div>
             <div class="row" style="margin-top: 5%">
                    <div class="col-xs-3"></div>
                    <div class="col-xs-3 text-center">
                        <hr>
                        <label >
                            Cajero: {{ Auth::user()->name }}
                        </label>
                    </div>
                    <div class="col-xs-3 text-center">
                        <hr>
                        <label >
                            Socio: {{$medidor->nombre}} {{$medidor->apellidoP}}
                        </label>
                    </div>
                    <div class="col-xs-3"></div>

                </div>

                <p id="monto">{{$montoT}}</p>
               
                <p id="sumaCubo">{{$cubosT}}</p>
                <p id="accionT">{{$accionT}}</p>
                <p id="multaT">{{$multaT}}</p>
            
                   <div class="container">
                        <button onclick="window.print();" class="btn btn-primary">Imprimir</button>
                   </div>
            
        
            
@endsection 
@section('scripts')
        <script>
            $(document).ready(function(){
                $('#monto').hide();
                $('#sumaCubo').hide();
                $('#accionT').hide();
                $('#multaT').hide();
                $('.total').val($('#monto').text());
                $('.cubosTotal').text($('#sumaCubo').text());
                $('.multaT').text($('#multaT').text());
                $('.accionT').text($('#accionT').text());
                window.print();
            });
            
        </script>
@endsection