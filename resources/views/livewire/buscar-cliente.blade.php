<div>
    <div class="mb-4">
        <x-filament::button wire:click="verificarCedula">Verificar Cédula</x-filament::button>
    </div>

    <div class="mb-4">
        <x-filament::input type="text" wire:model="cedula_cli" placeholder="Cédula del Cliente" />
    </div>

    @if ($is_cliente_found)
        <div>
            <x-filament::input type="text" wire:model="nombre_cli" placeholder="Nombre del Cliente" disabled />
            <x-filament::input type="text" wire:model="telefono_cli" placeholder="Teléfono del Cliente" disabled />
            <x-filament::input type="email" wire:model="email_cli" placeholder="E-mail del Cliente" disabled />
        </div>
    @endif
</div>
