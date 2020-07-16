<h1>Deudores Consumo</h1>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Meses</th>
                <th>Monto Bs.-</th>
               
            </tr>
        </thead>
        <tbody>
            @php
                $contador=0;
            @endphp
            @foreach($socio as $soc)
            @php
                $contador++;
            @endphp
            <tr>
                <td>{{ $contador }}</td>
                <td>{{ $soc->codigo }}</td>
                <td>{{ $soc->nombre }}</td>
                <td>{{ $soc->apellidoP }}</td>
                <td>{{ $soc->apellidoM }}</td>
               @php

                 $lectura=\DB::table('lectura as lec')
                      ->join('medidor as me','lec.idMedidor','=','me.idMedidor')
                      ->join('socio as s','me.idSocio','=','s.idSocio')
                      ->select('s.*,lec.mes')
                      ->where('lec.pago','=','No')
                      ->where('me.idSocio','=',$soc->idSocio)
                      ->count();

                  $monto=\DB::table('lectura as lec')
                      ->join('medidor as me','lec.idMedidor','=','me.idMedidor')
                      ->join('socio as s','me.idSocio','=','s.idSocio')
                      ->select('lec.totalPagar')
                      ->where('lec.pago','=','No')
                      ->where('me.idSocio','=',$soc->idSocio)
                      ->sum('lec.totalPagar');

                  $cantidad=$lectura;
                  $montoTotal=$monto;

               @endphp
                <td>{{ $cantidad }}</td>
                <td>{{ $montoTotal }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
