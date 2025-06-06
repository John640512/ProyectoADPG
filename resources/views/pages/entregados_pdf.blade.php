<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Productos Entregados - {{ $fecha }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        ul {
            margin: 0;
            padding-left: 15px;
        }
    </style>
</head>
<body>
    <h2>Productos Entregados - Fecha: {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</h2>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Negocio</th>
                <th>Cantidad (Ton)</th>
                <th>Trabajador</th>
                <th>Transporte</th>
                <th>Fecha de Entrega</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entregados as $entrega)
                @php
                    $transporte = $entrega->transporte;
                    $productos = $transporte->productos;
                    $ubicaciones = $transporte->ubicacionesEntrega;
                    $trabajador = $transporte->trabajador;
                    $tipoTransporte = $transporte->tipoTransporte;
                @endphp

                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $ubicaciones->pluck('nombre_negocio')->join(', ') ?: '—' }}</td>
                        <td>{{ $transporte->cantidad_toneladas }}</td>
                        <td>{{ $trabajador->nombre ?? '—' }}</td>
                        <td>{{ $tipoTransporte->nombre ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($entrega->fecha_entrega)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
