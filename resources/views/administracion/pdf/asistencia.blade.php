

    <h1>Listado Socios  <em style="float:right;font-size: 15px">Fecha: {{$fecha}} </em> </h1>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Codigo Medidor</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Estado</th>
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
                    <div style="width: 50%">
                        <input type="text" name="" id="" value=":">
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
