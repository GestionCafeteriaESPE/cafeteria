@props(['producto'])

<div class="bg-background rounded-lg shadow-lg overflow-hidden">
      <!--<img src="{{ asset('storage\imagenes\Producto' . $producto->imagenRef_pro ) }}" class="w-full h-64 object-cover" /> -->
     <img src="{{ asset('storage\imagenes\Producto') .'/'. $producto->imagenRef_pro  }}" class="w-full h-64 object-cover" />
    <div class="p-4">
        <h3 class="text-xl font-bold">{{ $producto->nombre_pro }}</h3>
        <p class="text-sm text-muted-foreground">{{ $producto->descripcion_pro }}</p>
        <p class="text-lg font-semibold">Precio: {{$producto->precio_pro}}</p>
        <p class="text-lg font-semibold">Disponibilidad: {{$producto->disponibilidad_pro}}</p>
    </div>
</div>