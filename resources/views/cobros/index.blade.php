@extends('layout.admin')
@section('scripts')
    <script>


        $(document).ready(function() {
            $('#proximo').hide();
            $('#proximoPago').hide();
            $('#enviar').hide();
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
            });
        });

        var totalPagoAgua=0;
        var totalPagoMulta=0;
        var montoPagar=0;
        var proximoPago='0000-00-00';
        var conteo=0;

        var multa=[];
        var lectura=[];
        var cobroAccion=[];

        var total3=0;
        $('.multa').on('change', function() {
            if ($(this).is(':checked') ) {
                multa.push($(this).val());
                totalPagoMulta+=$(this).data('monto');
                $('#total').html(totalPagoMulta);
                conteo++;
            } else {

                var contador=0;
                while (multa.length>contador) {
                    if (multa[contador]==$(this).val()) {
                        multa.splice(contador,1);
                        totalPagoMulta-=$(this).data('monto');
                        $('#total').html(totalPagoMulta);
                        conteo--;
                    }
                    contador++;
                }


            }
            boton(conteo);
        });
        var checks=[];
        $('.lectura').each(function(){
            checks.push($(this));
        });

        for (var i = 0; i <checks.length; i++) {
            (checks[i]).attr("disabled", true);
        }

        (checks[0]).attr("disabled", false);

        function habilitar(argument) {

            checks[argument+1].attr('disabled',false);

        }
        function deshabilitar(argument) {
            for (var i = argument; i <checks.length; i++) {
                checks[i].attr('disabled',true);
                if (checks[i].prop('checked')) {
                    checks[i].attr('checked',false);
                    console.log(checks[i]);
                    totalPagoAgua-=checks[i].data('monto');
                }

            }
            $('#total2').html(totalPagoAgua);
        }

        $('.lectura').on('change', function() {
            if ($(this).is(':checked'))
            {
                lectura.push($(this).val());
                totalPagoAgua+=$(this).data('monto');
                console.log($(this).data('monto'));
                $('#total2').html(totalPagoAgua);
                conteo++;
                habilitar($(this).data('numero'));

            }
            else {
                var num1=$(this).data('numero');
                if (num1==0) {
                    totalPagoAgua=0;
                    var c=1;
                    $('#total2').html(totalPagoAgua);
                    $('.lectura').each(function(){
                        $(this).attr('checked',false);
                        for (var i = 0; i <checks.length; i++) {
                            (checks[i]).attr("disabled", true);
                        }

                        (checks[0]).attr("disabled", false);
                    })
                }
                else{

                    var contador=0;
                    while (lectura.length>contador) {
                        if (lectura[contador]==$(this).val()) {
                            lectura.splice(contador,1);
                            totalPagoAgua-=$(this).data('monto');
                            console.log($(this).data('monto'));

                            $('#total2').html(totalPagoAgua);
                            deshabilitar(num1+1);

                            conteo--;
                        }
                        contador++;
                    }
                }
                // console.log(alert(contarTickeados(checks)));

                // alert(lectura);
            }
            boton(conteo);
        });
        $('.cobroAccion').on('change', function() {
            if ($(this).is(':checked') ) {
                cobroAccion.push($(this).val());
                conteo++;
                montoPagar=$('#montoPagar').val();
                total3=total3+parseInt(montoPagar);
                $('#total3').text("Bs.- " + total3);

            } else {
                var contador=0;
                while (cobroAccion.length>contador) {
                    if (cobroAccion[contador]==$(this).val()) {
                        cobroAccion.splice(contador,1);
                        conteo--;
                    }
                    contador++;
                }
                total3=0;
                $('#total3').text("Bs.- 0.00");
            }
            boton(conteo);

        });

        $('#montoPagar').on('keyup',function(){

            var montoPagar = $(this).val();
            var montoDebe = $('#montoDebe').text();
            if (montoPagar < montoDebe ) {
                $('#proximo').show(1000);
                $('#proximoPago').show(1000);
            }
            else{
                $('#proximo').hide(1000);
                $('#proximoPago').hide(1000);
            }
            if ( parseFloat(montoPagar) > parseFloat(montoDebe)) {
                $('#montoPagar').val(montoDebe);
            }
            else{

            }
        });

        function boton(conteo){
            if (conteo>0) {
                $('#enviar').show();
            }

            else{

                $('#enviar').hide();
            }
        }




        $('#enviar').click(function(e){
            e.preventDefault();
            var medidor=$('#idMedi').text();
            $.ajax({
                dataType:'json',
                type:'post',
                url: `{{route('cobros')}}`,
                data:{multa:multa,lectura:lectura,cobroAccion:cobroAccion,montoPagar:montoPagar,proximoPago:proximoPago,medidor}
            }).done(function(msg){

                var ml=msg.m;
                var lc=msg.l;
                var ca=msg.a;
                var medidor=msg.medidor;

                if (lc=="") {
                    lc=0;
                }
                if (ml=="") {
                    ml=0;
                }
                if (ca=="") {
                    ca=0;
                }
                $.ajax({
                    dataType:'json',
                    type:'post',
                    url: `{{route('cobro_reporte')}}`,
                    data:{ml,lc,
                        ca, medidor}
                }).done(function (data) {
                    $('#container_global').html(data.view);
                })
                // $(location).attr('href', '/cobros/reporte/'+ml+'/'+lc+'/'+ca+'/'+medidor);
            });
        });



        function verificarCheck() {
            for (var i = 0; i < checks.length; i++) {

                if ((i+1)>checks.length) {

                }
                else{

                    if((checks[i]).prop('checked') ) {
                        (checks[i+1]).attr("disabled", false);
                    }
                    else{
                        (checks[i+1]).attr("disabled", true);
                        (checks[i+1]).attr("checked", false);
                    }
                }
            }



        }



    </script>
@endsection
@section('contenido')
    <div class="container-fluid" id="container_global">
        <h1>Listado de Deudas del socio "<b>{{$socio->nombre.' '.$socio->apellidoP}}</b> <b id="idMedi">{{$medidor->codigo}}</b> "</h1>
        <h3>Multas</h3>
        @if($multa)
            @php
                $multaTotal=0;
            @endphp
            <table class="table table-striped table-bordered table-condensed table-hover table-responsive">
                <thead class="bg-primary">
                <th id="id">ID</th>
                <th>Concepto</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Pagar</th>
                </thead>
                @foreach($multa as $mul)
                    <tr>
                        <td>{{$mul->idMulta}}</td>
                        <td>{{$mul->concepto}}</td>
                        <td>{{$mul->fechaMulta}}</td>
                        <td id="monto">{{$mul->monto}}</td>
                        <td>
                            <input type="checkbox" class="form-checkbox-group multa" name="{{$mul->idMulta}}" id="multa"  data-monto="{{$mul->monto}}" value="{{$mul->idMulta}}">
                        </td>
                        @php
                            $multaTotal+=$mul->monto;
                        @endphp
                    </tr>
                @endforeach
                <tfoot>
                <th >Total</th>
                <th></th>
                <th></th>
                <th>{{$multaTotal}}</th>
                <th><h4 id="total">S/. 0.00</h4></th>
                </tfoot>
            </table>
        @else
            <p>No se encontraron multas pendientes</p>
        @endif

        <h3>Meses adeudados por consumo de Agua</h3>
        @if($agua)
            <table class="table table-striped table-bordered table-condensed table-hover table-responsive" >
                <thead class="bg-primary" >
                <th>Fecha Lectura</th>
                <th>Metros cubicos consumidos</th>
                <th>Mes</th>
                <th>Total a Pagar</th>
                <th>Pagar</th>
                </thead>
                @php
                    $monto=0;
                    $contador=0;

                @endphp
                @foreach ($agua as $ag)
                    <tr>
                        <td>{{$ag->fechaLectura}}</td>
                        <td>{{$ag->cantidadConsumo}}</td>
                        <td>{{$ag->mes}}</td>
                        <td>{{$ag->totalPagar}}</td>
                        <td>
                            <input type="checkbox" class="form-checkbox-group lectura" data-monto="{{$ag->totalPagar}}"  data-numero="{{$contador}}" name="{{$ag->idLectura}}" id="lectura" value="{{$ag->idLectura}}">
                        </td>
                        @php
                            $monto+=$ag->totalPagar;
                            $contador++;

                        @endphp
                    </tr>
                @endforeach
                <tfoot>
                <th colspan="2" style="text-align: center;">Total</th>
                <th></th>
                <th>{{$monto}}</th>
                <th><h4 id="total2">S/. 0.00</h4></th>
                </tfoot>
            </table>
        @else
            <p>No se encontraron Cobros de Agua pendientes</p>
        @endif
        <h3>Deudas por Accion</h3>
        @if($accion->accion < 3500)
            <table class="table table-striped table-bordered table-condensed table-hover table-responsive">
                <thead class="bg-primary">
                <th>Fecha Ultimo Pago</th>
                <th>Monto Pagado</th>
                <th>Monto en Deuda</th>
                <th>Monto a Pagar</th>
                <th id="proximo">Proximo Pago</th>
                <th>Pagar</th>
                </thead>
                <tr>
                    <td>{{$accion->fechaReg}}</td>
                    <td>{{$accion->accion}}</td>
                    <td id="montoDebe">{{3500 - $accion->accion}}</td>
                    <td><input type="text" name="montoPagar" value="{{3500 - $accion->accion}}" id="montoPagar"></td>
                    <td><input type="date" name="proximoPago" id="proximoPago" class="form-control" value="{{$fecha}}" ></td>
                    <td>
                        <input type="checkbox" class="form-checkbox-group cobroAccion" name="{{$accion->idCobroAccion}}" id="cobroAccion" value="{{$accion->idCobroAccion}}">
                    </td>
                </tr>
                <tfoot>
                <th>Total</th>
                <th></th>
                <th></th>
                <th><h4 id="total3">Bs.- 0.00</h4></th>
                </tfoot>
            </table>

        @else
            <p>No   se encontro pago pendiente de Cobro Accion</p>
        @endif
        `   <input type="submit" value="Cobrar Seleccionados" class="btn btn-primary" id="enviar">
    </div>
@endsection