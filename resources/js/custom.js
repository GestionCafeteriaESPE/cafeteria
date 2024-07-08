document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener('modal-closed', function() {
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
