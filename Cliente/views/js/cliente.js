
$('#cliente_actualizar').on('submit', function (event) {
    event.preventDefault();
    Swal.fire({
      title: 'Confirmación de Modificación',
      text: '¿Desea modificar los datos?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, modificar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        var formData = new FormData($('#cliente_actualizar')[0]);
        modificarCliente(formData);
      }
    });
  });
  
  function modificarCliente(formData) {
    $.ajax({
      url: '../../admin/Controllers/clienteController.php?op=editarCliente',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (datos) {
        switch (datos) {
          case '1':
            Swal.fire({
              icon: 'success',
              title: 'Éxito',
              text: 'Cliente actualizado exitosamente',
              showConfirmButton: true
            });
            break;
  
          case '2':
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Error: Cambiar los datos para Actualizar'
            });
            break;
  
          case '3':
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Error: No se pudo editar.'
            });
          default:
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: datos,
            });
            break;
        }
      },
    });
  }