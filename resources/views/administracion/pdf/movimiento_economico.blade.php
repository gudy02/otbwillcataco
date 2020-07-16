

    <h1>Listado Movimiento Economico  {{$tipo_movimiento}}<em style="float:right;font-size: 15px">Fecha: {{$fecha}} </em> </h1>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Tipo Movimiento</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @php
                $contador=0;
            @endphp
            @foreach($response as $item)
            <tr>
                @php
                    $contador++;
                @endphp
                <td>{{ $contador }}</td>
                <td>{{ $tipo_movimiento }}</td>
                <td>{{ $item->descripcion }}</td>
                <td>{{ $item->fecha }}</td>
                <td>{{ $item->monto }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
