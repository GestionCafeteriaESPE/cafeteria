<div style="border: 1px solid #e2e8f0; border-radius: 0.375rem; padding: 1rem; background: #fff;">
    <h3 style="margin: 0; font-weight: bold;">{{ $heading }}</h3>
    <div style="border-bottom: 2px solid #e2e8f0; margin: 1.0rem 0; width: calc(100% + 2rem); margin-left: -1rem; margin-right: -1rem;;"></div>
    <div>
        @foreach ($productos as $producto)
            <div style="padding: 0.5rem 0; display: flex; justify-content: space-between;">
                <span>{{ $producto->nombre_pro }}</span>
                <span>
                    @if ($producto->disponibilidad_pro)
                        Disponible ✅
                    @else
                        No disponible ❌
                    @endif
                </span>
            </div>
        @endforeach
    </div>
</div>

