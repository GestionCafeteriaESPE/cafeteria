<x-filament-panels::page>
    <h2>Reporte de Pedidos</h2>

    <!-- Contenedor para los botones -->
    <div class="flex justify-between items-center mb-4">
        <!-- Formulario para seleccionar el año -->
        <form method="GET" class="flex items-center">
            <label for="year">Seleccionar Año:</label>
            <select name="year" id="year" class="ml-2">
                @foreach (range(now()->year, now()->year - 10) as $year)
                <option value="{{ $year }}" @if(request('year')==$year) selected @endif>{{ $year }}</option>
                @endforeach
            </select>
            <button type="submit" class="ml-2 px-4 py-2 text-white" style="background-color: #D1A6A0;">Filtrar</button>
        </form>

        <!-- Botón para generar PDF -->
        <a href="{{ route('reporte.pedidos.pdf', ['year' => request('year', now()->year)]) }}" class="px-4 py-2 text-white" style="background-color: #4CAF50;">Generar PDF</a>
    </div>

    <!-- Tabla para mostrar los pedidos agrupados por mes -->
    @if ($pedidos->isEmpty())
    <p>No hay datos para el año seleccionado.</p>
    @else
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Mes</th>
                <th class="px-4 py-2">Total de Pedidos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $mes => $total)
            <tr>
                <td class="border px-4 py-2">{{ $mes }}</td>
                <td class="border px-4 py-2">{{ $total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</x-filament-panels::page>