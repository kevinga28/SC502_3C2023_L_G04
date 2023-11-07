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
          return '<a type="button" class="btn btn-danger float-right" id="eliminar-cliente" data-clienteId="<?= $clienteId ?>"><i class="fas fa-trash"></i> Eliminar</a>' +
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
  console.log('Formulario enviado');
  $('#btnRegistrar').prop('disabled', true);
  var formData = new FormData($('#crearCliente')[0]);
  console.log('Datos del formulario:', formData);
  $.ajax({
    url: '../../../admin/Controllers/clienteController.php?op=insertar',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log('Respuesta del servidor:', datos);
      switch (datos) {
        case '1':
          toastr.success(
            'Cliente registrado'
          );
          $('#crearCliente')[0].reset();
          tabla.api().ajax.reload();
          break;
        case '2':
          toastr.error('El correo ya existe. Corrija e inténtelo nuevamente.');
          break;
        case '3':
          toastr.error('El correo ya existe. Corrija e inténtelo nuevamente.');
          break;
        // Otros casos según tus necesidades
        default:
          toastr.error(datos);
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

        // Rellena el formulario con los datos obtenidos
        $("#Enombre").val(datos.nombre);
        $("#Eapellido").val(datos.apellido);
        $("#Ecorreo").val(datos.correo);
        $("#Etelefono").val(datos.telefono);
        $("#Eprovincia").val(datos.provincia);
        $("#Edistrito").val(datos.distrito);
        $("#Ecanton").val(datos.canton);
        $("#Eotros").val(datos.otros);
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
  bootbox.confirm('¿Desea modificar los datos?', function (result) {
    if (result) {
      var formData = new FormData($('#cliente_update')[0]);
      $.ajax({
        url: '../../../admin/Controllers/clienteController.php?op=editar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
          //alert(datos);
          switch (datos) {
            case '0':
              toastr.error('Error: No se pudieron actualizar los datos');
              break;
            case '1':
              toastr.success('Cliente actualizado exitosamente');
              tabla.api().ajax.reload();
              limpiarForms();
              $('#formulario_update').hide();
              $('#formulario_add').show();
              break;
            case '2':
              toastr.error('Error: IdCliente no se puede editar.');
              break;
          }
        },
      });
    }
  });
});

/* ---------------------------------------------------------------ELIMINAR EL CLIENTE MEDIANTE EL ID--------------------------------------------------------------- */

$(document).ready(function() {
  $('.eliminar-cliente').on('click', function(event) {
    const clienteId = $(this).data('cliente-id');

    if (clienteId) {
      if (confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
        // Realiza una solicitud al controlador para eliminar el cliente
        fetch(`../../../admin/Controllers/clienteController.php?op=eliminar&IdCliente=${clienteId}`, {
          method: 'POST',
        })
          .then(response => {
            if (response.ok) {
              alert("Cliente eliminado exitosamente");
              // Puedes actualizar la vista o la lista de clientes en la página si es necesario.
              // Por ejemplo, puedes eliminar la fila correspondiente de la tabla.
              $(this).closest('tr').remove(); // Elimina la fila de la tabla.
            } else {
              alert("No se pudo eliminar el cliente. Inténtalo de nuevo.");
            }
          })
          .catch(error => {
            console.error("Error al eliminar el cliente:", error);
          });
      }
    }
  });
});




