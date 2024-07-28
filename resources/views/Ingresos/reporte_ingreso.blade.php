<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reporte de Ingresos</title>
    <style>
        [x-cloak] {
                display: none !important;
            }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Reporte de Ingresos</h1>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingresos as $ingreso)
            <tr>
                <td>{{ $ingreso->fecha_ing }}</td>
                <td>{{ $ingreso->descripcion_ing }}</td>
                <td>${{ $ingreso->cantidad_ing }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
