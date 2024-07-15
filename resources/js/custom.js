document.addEventListener('DOMContentLoaded', function() {
    console.log('Custom JS loaded');

    // Escuchar el evento de cliente verificado
    window.addEventListener('clienteVerificado', function() {
        // Cierra el modal y elimina el overlay oscuro
        const modal = document.querySelector('.fi-modal');
        if (modal) {
            modal.classList.remove('fi-modal-open');
        }
        const overlay = document.querySelector('.fi-modal-close-overlay');
        if (overlay) {
            overlay.style.display = 'none';
        }

        // Dispatch custom event to close the modal
        document.querySelector('[x-ref="modalContainer"]').dispatchEvent(
            new CustomEvent('modal-closed', { detail: { id: 'A5ETNx7hZ5nqUAWWCLr9-action' } })
        );
    });
    
    // Escuchar el evento de cliente verificado
    Livewire.on('clienteVerificado', function() {
        console.log('Event clienteVerificado received');

        // Cierra el modal y elimina el overlay oscuro
        const modal = document.querySelector('.fi-modal');
        if (modal) {
            modal.classList.remove('fi-modal-open');
        }
        const overlay = document.querySelector('.fi-modal-close-overlay');
        if (overlay) {
            overlay.style.display = 'none';
        }

        // Dispatch custom event to close the modal
        const modalContainer = document.querySelector('[x-ref="modalContainer"]');
        if (modalContainer) {
            modalContainer.dispatchEvent(
                new CustomEvent('modal-closed', { detail: { id: 'A5ETNx7hZ5nqUAWWCLr9-action' } })
            );
        }
    });

    $wire.dispatch('clienteVerificado', function() {
        console.log('Event clienteVerificado received');
        
        // Cierra el modal y elimina el overlay oscuro
        const modal = document.querySelector('.fi-modal');
        if (modal) {
            modal.classList.remove('fi-modal-open');
        }
        const overlay = document.querySelector('.fi-modal-close-overlay');
        if (overlay) {
            overlay.style.display = 'none';
        }

        // Dispatch custom event to close the modal
        const modalContainer = document.querySelector('[x-ref="modalContainer"]');
        if (modalContainer) {
            modalContainer.dispatchEvent(
                new CustomEvent('modal-closed', { detail: { id: 'A5ETNx7hZ5nqUAWWCLr9-action' } })
            );
        }
    });
});

document.addEventListener('cliente-verificado', function (event) {
    // Cierra el modal
    Livewire.emit('closeModal');
});
