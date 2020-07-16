<h1>RECIBO</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Monto Pagado</th>
            <th>Fecha Pago</th>
            <th>Motivo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($socio as $soc)
        <tr>
            <td>{{ $soc->idSocio }}</td>
            <td>{{ $soc->nombre }}</td>
            <td>{{ $soc->apellidoP }}</td>
            <td>{{ $soc->apellidoM }}</td>
            <td>{{ $soc->accion }}</td>
            <td>{{ $soc->fechaReg }}</td>
            <td>{{ $soc->concepto }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<hr>
