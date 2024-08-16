<x-filament-panels::page>
    <h2>Reporte de Egresos</h2>

    <div class="flex justify-between items-center mb-4">
        <!-- Formulario para seleccionar el año -->
        <form method="GET" class="flex items-center">
            <label for="year">Seleccionar Año:</label>
            <select name="year" id="year" class="ml-2">
                @foreach (range(now()->year, now()->year - 20) as $year)
                    <option value="{{ $year }}" @if(request('year') == $year) selected @endif>{{ $year }}</option>
                @endforeach
            </select>
            <button type="submit" class="ml-2 px-4 py-2 text-white" style="background-color: #D1A6A0;">Filtrar</button>
        </form>

        <!-- Botón para generar PDF -->
        <a href="{{ route('reporte.egresos.pdf', ['year' => request('year', now()->year)]) }}" class="px-4 py-2 text-white" style="background-color: #4CAF50;">Generar PDF</a>
    </div>

    <!-- Tabla para mostrar los egresos agrupados por mes -->
    @if ($egresos->isEmpty())
        <p>No hay datos para el año seleccionado.</p>
    @else
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Mes</th>
                    <th class="px-4 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($egresos as $mes => $total)
                    <tr>
                        <td class="border px-4 py-2">{{ $mes }}</td>
                        <td class="border px-4 py-2">{{ $total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-filament-panels::page>
