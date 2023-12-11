
function limpiarForms() {
  $('#tratamiento_add').trigger('reset');
  $('#ratamiento_update').trigger('reset');
}

/* ---------------------------------------------------------------LISTAR LOS TratamientoS--------------------------------------------------------------- */
function listarTratamientos() {
  tabla = $('#listado').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../../admin/Controllers/tratamientoController.php?op=listaTabla',
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
      { data: "0" },  // IdTratamiento
      { data: "1" },  // nombre
      { data: "2" },  // descrip
      { data: "3" },  // Precio
      {
        // Última columna con botones
        data: null,
        render: function (data, type, row) {
          return '<a type="button" class="btn btn-danger float-right eliminar-tratamiento" data-id="' + data[0] + '"><i class="fas fa-trash"></i> Eliminar</a>' +
            '<a id="modificarTratamiento" class="editar-btn btn btn-success float-right" style="margin-right: 8px;" href="editarTratamiento.php?IdTratamiento=' + data[0] + '"><i class="fas fa-pencil-alt"></i>Editar</a>' +
            '<a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verTratamiento.php?IdTratamiento=' + data[0] + '"><i class="fas fa-eye"></i>Ver</a>';
        }
      }
    ]
  });
}
$(function () {
  listarTratamientos();
});

/* ---------------------------------------------------------------CREAR TRATAMIENTO--------------------------------------------------------------- */
$('#crearTratamiento').on('submit', function (event) {
  event.preventDefault();
  $('#btnRegistrar').prop('disabled', true);
  var formData = new FormData($('#crearTratamiento')[0]);
  $.ajax({
    url: '../../../admin/Controllers/tratamientoController.php?op=insertar',
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
            text: 'Tratamiento registrado',
          }).then((result) => {
            if (result.isConfirmed) {
              $('#crearTratamiento')[0].reset();
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
            text: 'El tratamiento ya existe. Corrija e inténtelo nuevamente.',
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
      $('#btnRegistrarTratamiento').removeAttr('disabled');
    },
  });
});


/* ---------------------------------------------------------------OBTENER DATOS DEL TRATAMIENTO--------------------------------------------------------------- */
const rellenarFormularioTratamiento = async () => {
  const urlSearchParams = new URLSearchParams(window.location.search);
  const IdTratamiento = urlSearchParams.get("IdTratamiento");

  if (IdTratamiento) {
    try {
      const response = await fetch(`../../../admin/Controllers/tratamientoController.php?op=obtener&IdTratamiento=${IdTratamiento}`);
      if (response.ok) {
        const datos = await response.json();

        $("#Enombre").val(datos.nombre);
        $("#Edescripcion").val(datos.descripcion);
        $("#Eprecio").val(datos.precio);
        $("#Eduracion").val(datos.duracion);
        $("#EIdTratamiento").val(datos.IdTratamiento);
      } else {
        console.error("Error en la respuesta de la solicitud AJAX:", response.statusText);
        console.error(await response.text()); // Muestra el contenido del error
      }
    } catch (error) {
      console.error("Error en la solicitud AJAX:", error);
    }
  }
};

rellenarFormularioTratamiento();
/* ---------------------------------------------------------------EDITAR DATOS DEL TRATAMIENTO--------------------------------------------------------------- */
$('#tratamiento_update').on('submit', function (event) {
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
      var formData = new FormData($('#tratamiento_update')[0]);
      modificarTratamiento(formData);
    }
  });
});

function modificarTratamiento(formData) {
  $.ajax({
    url: '../../../admin/Controllers/tratamientoController.php?op=editar',
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
            text: 'Tratamiento actualizado exitosamente',
            showConfirmButton: false
          });
          setTimeout(function () {
            window.location.href = 'listaTratamiento.php'; // Redirige a la lista después de 1 segundo
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
          break;
          
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

/* ---------------------------------------------------------------ELIMINAR TRATAMIENTO MEDIANTE EL ID--------------------------------------------------------------- */

// Eliminar una tratamiento
$(document).on('click', '.eliminar-tratamiento', function () {
  var id = $(this).data('id');
  console.log('Id de la tratamiento: ' + id);

  Swal.fire({
    title: 'Confirmación de Eliminación',
    text: '¿Estás seguro de que deseas eliminar esta tratamiento?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      eliminarTratamiento(id);
    }
  });
});


function eliminarTratamiento(id) {
  $.ajax({
    url: '../../../admin/Controllers/tratamientoController.php?op=eliminar',
    method: 'POST',
    data: { op: 'eliminar', id: id },
    success: function (response) {
      switch (response) {
        case '1':
          Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Tratamiento eliminado exitosamente',
            showConfirmButton: false
          });
          setTimeout(function () {
            location.reload(); // Recargar la página o redirigir si es necesario
          }, 1800);
          break;
        case '2':
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error: No se pudieron cambiar los datos antes de eliminar'
          });
          break;
        case '3':
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo eliminar el tratamiento. Asegúrate de que no haya facturas asociadas.'
          });
          break;
        default:
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error inesperado. No se pudo eliminar la tratamiento.'
          });
      }
    },
    error: function (error) {
      console.error("Error al eliminar el tratamiento:", error);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se pudo eliminar el tratamiento. Inténtalo de nuevo'
      });
    }
  });
}



/* --------------------------------------------------------------LISTA TRATAMIENTO en Cita --------------------------------------------------------------- */

$(document).ready(function () {
  $.ajax({
    url: '../../../admin/Controllers/tratamientoController.php?op=listaTratamiento',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      // Verifica si se recibieron datos
      if (data.length > 0) {
        var select = $('#tratamiento');

        select.empty();

        // Recorre los datos y agrega opciones al select
        $.each(data, function (index, tratamiento) {
          var option = $('<option>', {
            value: tratamiento.IdTratamiento, // Cambia a ID del tratamiento
            'data-precio': tratamiento.precio,
            'data-duracion': tratamiento.duracion 
          }).text(tratamiento.nombre + ' - ₡' + tratamiento.precio + ' - dur: '+ tratamiento.duracion );

          select.append(option);
        });
      } else {
        console.log('No se encontraron tratamientos.');
      }
    },
    error: function (error) {
      console.log('Error en la solicitud AJAX: ' + error.responseText);
    }
  });
});




/* --------------------------------------------------------------Editar TRATAMIENTO en Cita--------------------------------------------------------------- */

$(document).ready(function () {
  $.ajax({
    url: '../../../admin/Controllers/tratamientoController.php?op=listaTratamiento',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      // Verifica si se recibieron datos
      if (data.length > 0) {
        var select = $('#Etratamiento');

        select.empty();

        // Recorre los datos y agrega opciones al select
        $.each(data, function (index, tratamiento) {
          var option = $('<option>', {
            value: tratamiento.IdTratamiento, // Cambia a ID del tratamiento
            'data-precio': tratamiento.precio,
            'data-duracion': tratamiento.duracion 
          }).text(tratamiento.nombre + ' - ₡' + tratamiento.precio + ' - dur: '+ tratamiento.duracion );

          select.append(option);
        });
      } else {
        console.log('No se encontraron tratamientos.');
      }
    },
    error: function (error) {
      console.log('Error en la solicitud AJAX: ' + error.responseText);
    }
  });
});