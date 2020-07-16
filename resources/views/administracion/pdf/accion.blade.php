<h1>Deudores por Accion</h1>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Kardex</th>
                <th>Monto por Cobrar</th>
               
            </tr>
        </thead>
        <tbody>
            @php
                $contador=0;
            @endphp
            @foreach($deudores as $deu)
            @php
            $contador++;
        @endphp
            <tr>

                <td>{{ $contador}}</td>
                <td>{{ $deu->nombre }}</td>
                <td>{{ $deu->apellidoP }}</td>
                <td>{{ $deu->apellidoM }}</td>
                <td>{{ $deu->codigo }}</td>

                <td>{{3500- $deu->accion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
