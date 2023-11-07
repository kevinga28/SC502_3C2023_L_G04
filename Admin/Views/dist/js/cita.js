

/* ---------------------------------------------------------------LISTAR LOS CLIENTES--------------------------------------------------------------- */
function listarCitasTodas() {
  tabla = $('#listadoCita').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../../admin/Controllers/citaController.php?op=listaTabla',
      type: 'get',
      dataType: 'json',
      error: function (e) {
        console.log(e.responseText)
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
      { data: "0" },  // Idcita
      { data: "1" },  // Cliente
      { data: "2" },  // Estilista
      { data: "3" },  // Tratamiento
      { data: "4" },  // Fecha
      { data: "5" },  // Hora
      {
        // Última columna con botones
        data: null,
        render: function (data, type, row) {
          return '<a type="button" class="btn btn-danger float-right eliminar-cita" data-Idcita="<?= $Idcita ?>"><i class="fas fa-trash"></i> Eliminar</a>' +
            '<a id="modificarCliente" class="editar-btn btn btn-success float-right" style="margin-right: 8px;" href="editarCita.php?Idcita=' + data[0] + '"><i class="fas fa-pencil-alt"></i>Editar</a>' +
            '<a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verCita.php?Idcita=' + data[0] + '"><i class="fas fa-eye"></i>Ver</a>';
        }
      }
    ]
  });
}
$(function () {
  listarCitasTodas();
});



/* ---------------------------------------------------------------CREAR LOS CLIENTES--------------------------------------------------------------- */

$('#crearCita').on('submit', function (event) {
  event.preventDefault();
  console.log('Formulario enviado');
  $('#btnRegistrarCita').prop('disabled', true);
  var formData = new FormData($('#crearCita')[0]);
  console.log('Datos del formulario:', formData);
  $.ajax({
    url: '../../../admin/Controllers/citaController.php?op=insertar',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log('Respuesta del servidor:', datos);
      switch (datos) {
        case '1':
          toastr.success('Cita registrada exitosamente');
          $('#crearCita')[0].reset();
          // Puedes realizar otras acciones, como actualizar la lista de citas en la página.
          break;
        case '2':
          toastr.error('Error: No se pudo registrar la cita. Corrija e inténtelo nuevamente.');
          break;
        // Otros casos según tus necesidades
        default:
          toastr.error(datos);
          break;
      }
      $('#btnRegistrarCita').removeAttr('disabled');
    },
  });
});



/* ---------------------------------------------------------------OBTENER LOS DATOS DEL CLIENTE--------------------------------------------------------------- */
const rellenarFormularioCita = async () => {
  const urlSearchParams = new URLSearchParams(window.location.search);
  const IdCita = urlSearchParams.get("IdCita");

  if (IdCita) {
    try {
      const response = await fetch(`../../../admin/Controllers/citaController.php?op=obtener&IdCita=${IdCita}`);
      if (response.ok) {
        const datos = await response.json();

        // Rellena el formulario con los datos obtenidos
        // Aquí debes seleccionar los campos y asignar los valores adecuados en tu formulario de edición de citas.
      } else {
        console.error("Error al obtener los datos de la cita");
      }
    } catch (error) {
      console.error("Error en la solicitud AJAX:", error);
    }
  }
};

rellenarFormularioCita();

/* ---------------------------------------------------------------EDITAR LOS DATOS DEL CLIENTE--------------------------------------------------------------- */

$('#cita_update').on('submit', function (event) {
  event.preventDefault();
  bootbox.confirm('¿Desea modificar los datos de la cita?', function (result) {
    if (result) {
      var formData = new FormData($('#cita_update')[0]);
      $.ajax({
        url: '../../../admin/Controllers/citaController.php?op=editar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
          switch (datos) {
            case '0':
              toastr.error('Error: No se pudieron actualizar los datos de la cita');
              break;
            case '1':
              toastr.success('Cita actualizada exitosamente');
              // Puedes realizar acciones adicionales, como actualizar la lista de citas en la página.
              limpiarForms(); // Limpia el formulario de edición
              $('#formulario_update').hide(); // Oculta el formulario de edición
              $('#formulario_add').show(); // Muestra el formulario de creación
              break;
            // Otros casos según tus necesidades
          }
        },
      });
    }
  });
});
/* ---------------------------------------------------------------ELIMINAR EL CLIENTE MEDIANTE EL ID--------------------------------------------------------------- */

$('.eliminar-cita').on('click', function(event) {
  event.preventDefault();
  const urlSearchParams = new URLSearchParams(window.location.search);
  const citaId = urlSearchParams.get("IdCita");

  if (citaId) {
    if (confirm("¿Estás seguro de que deseas eliminar esta cita?")) {
      fetch(`../../../admin/Controllers/citaController.php?op=eliminar&IdCita=${citaId}`, {
        method: 'POST',
      })
        .then(response => {
          if (response.ok) {
            alert("Cita eliminada exitosamente");
            // Puedes realizar acciones adicionales, como actualizar la lista de citas en la página.
          } else {
            alert("No se pudo eliminar la cita. Inténtalo de nuevo.");
          }
        })
        .catch(error => {
          console.error("Error al eliminar la cita:", error);
        });
    }
  }
});
