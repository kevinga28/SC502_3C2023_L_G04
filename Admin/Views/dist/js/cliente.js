function limpiarForms() {
  $('#modulos_add').trigger('reset');
  $('#modulos_update').trigger('reset');
}

/* ---------------------------------------------------------------LISTAR LOS CLIENTES--------------------------------------------------------------- */
function listarClientesTodos() {
  tabla = $('#tbllistado').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../../admin/Controllers/clienteController.php?op=listaTabla',
      type: 'get',
      dataType: 'json',
      error: function (e) {
        console.log(e.responseText);
      },

      bDestroy: true,
      iDisplayLength: 5,

    }, language: {
      sProcessing: "Procesando...", // Mensaje de procesamiento
      sLengthMenu: "Mostrar _MENU_ registros", // Menú para seleccionar cantidad de registros por página
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando _START_ al _END_ de _TOTAL_ registros",
      sInfoEmpty: "Mostrando 0 al 0 de 0 registros",
      sInfoFiltered: "(filtrado de _MAX_ registros en total)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending: ": Activar para ordenar la columna en orden ascendente",
        sSortDescending: ": Activar para ordenar la columna en orden descendente",
      },
    },
    columns: [
      { data: "0" },  // IdCliente
      { data: "1" },  // Correo
      { data: "2" },  // Nombre
      { data: "3" },  // Apellido
      { data: "4" },  // Telefono
      { data: "5" },  // Provincia
      {
        // Última columna con botones
        data: null,
        render: function (data, type, row) {
          return '<a type="button" class="btn btn-danger float-right eliminar-cliente" data-id="' + data[0] + '"><i class="fas fa-trash"></i> Eliminar</a>' +
            '<a id="modificarCliente" class="editar-btn btn btn-success float-right" style="margin-right: 8px;" href="editarCliente.php?IdCliente=' + data[0] + '"><i class="fas fa-pencil-alt"></i>Editar</a>' +
            '<a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verCliente.php?IdCliente=' + data[0] + '"><i class="fas fa-eye"></i>Ver</a>';
        }
      }
    ]
  });
}
$(function () {

  listarClientesTodos();
});

/* ---------------------------------------------------------------CREAR LOS CLIENTES--------------------------------------------------------------- */

$('#crearCliente').on('submit', function (event) {
  event.preventDefault();
  $('#btnRegistrar').prop('disabled', true);
  var formData = new FormData($('#crearCliente')[0]);
  $.ajax({
    url: '../../../admin/Controllers/clienteController.php?op=insertar',
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
            text: 'Cliente registrado',
          }).then((result) => {
            if (result.isConfirmed) {
              $('#crearCliente')[0].reset();
              tabla.api().ajax.reload();
            }
          });
          break;
        case '2':
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudieron actualizar los datos',
          });
          break;
        case '3':
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El correo ya existe. Corrija e inténtelo nuevamente.',
          });
          break;

        default:
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: datos,
          });
          break;
      }
      $('#btnRegistrar').removeAttr('disabled');
    },
  });
});


/* ---------------------------------------------------------------OBTENER LOS DATOS DEL CLIENTE--------------------------------------------------------------- */

const rellenarFormulario = async () => {
  const urlSearchParams = new URLSearchParams(window.location.search);
  const IdCliente = urlSearchParams.get("IdCliente");

  if (IdCliente) {
    try {
      const response = await fetch(`../../../admin/Controllers/clienteController.php?op=obtener&IdCliente=${IdCliente}`);
      if (response.ok) {
        const datos = await response.json();

        $("#EIdCliente").val(datos.IdCliente);
        $("#Enombre").val(datos.nombre);
        $("#Eapellido").val(datos.apellido);
        $("#Ecorreo").val(datos.correo);
        $("#Etelefono").val(datos.telefono);
        $("#Eprovincia").val(datos.provincia);
        $("#Edistrito").val(datos.distrito);
        $("#Ecanton").val(datos.canton);
        $("#Eotros").val(datos.otros);
        var tipo = datos.tipoCliente;
        var valorMostrado;
        
        if (tipo === 0) {
            valorMostrado = 'Cliente';
        } else if (tipo === 1) {
            valorMostrado = 'Empleado';
        } else {
            // Manejar otro caso si es necesario
            valorMostrado = 'Desconocido';
        }
        
        $("#EtipoCliente").val(valorMostrado);
      } else {
        console.error("Error al obtener los datos del cliente");
      }
    } catch (error) {
      console.error("Error en la solicitud AJAX:", error);
    }
  }
};

rellenarFormulario(); // Llamar la funcion 

/* ---------------------------------------------------------------EDITAR LOS DATOS DEL CLIENTE--------------------------------------------------------------- */
$('#cliente_update').on('submit', function (event) {
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
      var formData = new FormData($('#cliente_update')[0]);
      modificarCliente(formData);
    }
  });
});

function modificarCliente(formData) {
  $.ajax({
    url: '../../../admin/Controllers/clienteController.php?op=editar',
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
            showConfirmButton: false
          });
          setTimeout(function () {
            window.location.href = 'listaClientes.php'; // Redirige a la lista después de 1 segundo
          }, 1000)
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

/* ---------------------------------------------------------------ELIMINAR EL CLIENTE MEDIANTE EL ID--------------------------------------------------------------- */
$(document).on('click', '.eliminar-cliente', function () {
  var id = $(this).data('id');
  console.log('id del cliente: ' + id);

  Swal.fire({
    title: 'Confirmación de Eliminación',
    text: '¿Estás seguro de que deseas eliminar este Cliente?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      eliminarCliente(id);
    }
  });
});

function eliminarCliente(id) {
  $.ajax({
    url: '../../../admin/Controllers/clienteController.php?op=eliminar',
    method: 'POST',
    data: { op: 'eliminar', id: id },
    success: function (response) {
      if (response === '1') {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'No se pudo eliminar el Cliente. Inténtalo de nuevo'
        });
      } else {
        Swal.fire({
          icon: 'success',
          title: 'Éxito',
          text: 'Se eliminó el cliente correctamente',
          showConfirmButton: false
        });
        setTimeout(function () {
          location.reload();
        }, 1800);
      }
    },
    error: function (error) {
      console.error("Error al eliminar el Cliente:", error);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se pudo eliminar el Cliente. Inténtalo de nuevo'
      });
    }
  });
}










