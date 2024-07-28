<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reporte de Egresos</title>
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
    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body>
    <h1>Reporte de Egresos</h1>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($egresos as $egreso)
            <tr>
                <td>{{ $egreso->fecha_Egr }}</td>
                <td>{{ $egreso->descripcion_Egr }}</td>
                <td>${{ $egreso->cantidad_Egr }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @filamentScripts
    @vite('resources/js/app.js')
</body>
</html>
