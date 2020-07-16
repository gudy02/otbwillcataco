

    <h1>Listado Socios</h1>

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Codigo Medidor</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Lectura Anterior</th>
                <th>Lectura Actual</th>
            </tr>
        </thead>
        <tbody>
            @php
                $contador=0;
            @endphp
            @foreach($socio as $soc)
            <tr>
                @php
                    $contador++;
                @endphp
                <td>{{ $contador }}</td>
                <td>{{ $soc->codigo }}</td>
                <td>{{ $soc->nombre }}</td>
                <td>{{ $soc->apellidoP }}</td>
                <td>{{ $soc->apellidoM }}</td>
                <td>
                    @php
                        $lectura=\DB::table('lectura')
                        ->select('lectura.lecturaActual')
                        ->where('lectura.idMedidor' ,$soc->idMedidor)
                        ->orderBy('lecturaActual','desc')
                        ->first();

                       echo($lectura->lecturaActual);
                        
                    @endphp
                </td>
                <td>
                    <div style="width: 100%">
                        <input type="text" name="" id="" value=":">
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
