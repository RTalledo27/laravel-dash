import './bootstrap';

// Código para obtener el ID del producto seleccionado
document.querySelectorAll('.btn-danger').forEach(button => {
    button.addEventListener('click', event => {
      const selectedProductId = event.target.closest('tr').dataset.id;
  
      const modal = document.getElementById('modal-confirma');
      modal.querySelector('.btn-ok').setAttribute('href', `/producto/eliminar/${selectedProductId}`);
  
      // Agrega el siguiente código para enviar el ID del registro al botón "Actualizar estado"
      modal.querySelector('.btn-primary').setAttribute('href', `/productos/updateStatus/${selectedProductId}`);
  
      modal.show();
    });
  });