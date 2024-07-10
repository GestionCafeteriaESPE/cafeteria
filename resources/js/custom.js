document.addEventListener('DOMContentLoaded', function() {
    console.log('Custom JS loaded');
    /*window.addEventListener('modal-closed', function() {
        // Cierra el modal y elimina el overlay oscuro
        const modal = document.querySelector('.modal');
        if (modal) {
            modal.style.display = 'none';
        }
        const overlay = document.querySelector('.modal-backdrop');
        if (overlay) {
            overlay.remove();
        }
    });*/
    
    // Escuchar el evento de cliente verificado
    Livewire.on('clienteVerificado', function() {
        // Cierra el modal y elimina el overlay oscuro
        const modal = document.querySelector('.modal');
        if (modal) {
            modal.style.display = 'none';
        }
        const overlay = document.querySelector('.modal-backdrop');
        if (overlay) {
            overlay.remove();
        }
    });
});

document.addEventListener('cliente-verificado', function (event) {
    // Cierra el modal
    Livewire.emit('closeModal');
});
