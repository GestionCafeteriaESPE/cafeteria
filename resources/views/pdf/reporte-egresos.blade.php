<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }

        .container {
            padding: 20px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 40px;
            table-layout: fixed;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo {
            width: 30%;
            /* Ajuste a 30% para más equilibrio */
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            text-align: left;
            width: 70%;
            /* Ajuste a 70% para más espacio */
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        .content {
            margin-top: 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>

    <div class="container">
        <table class="header-table">
            <tr>
                <td class="logo">
                    <img src="{{ $logo }}" alt="Logo de la Empresa" style="width: 100px;">
                </td>
                <td class="company-name">
                    ELIAS CAFETERIA
                </td>
            </tr>
        </table>

        <div class="title">
            Reporte de Egresos - Año {{ $year }}
        </div>

        <div class="content">
            @if ($egresos->isEmpty())
            <p>No hay datos para el año seleccionado.</p>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($egresos as $mes => $total)
                    <tr>
                        <td>{{ $mes }}</td>
                        <td>{{ $total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>

</body>

</html>