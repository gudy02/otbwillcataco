    <h1>Listado Socios con Multas</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Monto</th>
                <th>Fecha Multa</th>
                <th>Motivo</th>
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
                <td>{{ $soc->idSocio }}</td>
                <td>{{ $soc->nombre }}</td>
                <td>{{ $soc->apellidoP }}</td>
                <td>{{ $soc->apellidoM }}</td>
                <td>{{ $soc->monto }}</td>
                <td>{{ $soc->fechaMulta }}</td>
                <td>{{ $soc->concepto }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
