function limpiarForms() {
  $('#modulos_add').trigger('reset');
  $('#modulos_update').trigger('reset');
}

/* --------------------------------------------------------------- LISTAR LOS PRODUCTOS --------------------------------------------------------------- */
function listarProductos() {
  tabla = $('#tblistado').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../../admin/Controllers/productoController.php?op=listaProducto',
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
        { data: "0" },  // Codigo
        { data: "1" },  // Nombre
        { data: "2" },  // Descripcion
        { data: "3" },  // Cantidad
        { data: "4" },  // Precio
        {
          // Última columna con botones
          data: null,
          render: function (data, type, row) {
            return '<a type="button" class="btn btn-danger float-right eliminar-producto" data-cod="' + data[0] + '"><i class="fas fa-trash"></i> Eliminar</a>' +
            '<a id="modificarProducto" class="editar-btn btn btn-success float-right" style="margin-right: 8px;" href="editarProducto.php?Codigo=' + data[0] + '"><i class="fas fa-pencil-alt"></i>Editar</a>' +
            '<a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verProducto.php?Codigo=' + data[0] + '"><i class="fas fa-eye"></i>Ver</a>';
          }
        }
      ]
    });
  }
  $(function () {
  
    listarProductos();
  });
  
  /* --------------------------------------------------------------- CREAR LOS PRODUCTOS --------------------------------------------------------------- */
  $('#crearProducto').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistrar').prop('disabled', true);
    var formData = new FormData($('#crearProducto')[0]);
    $.ajax({
      url: '../../../admin/Controllers/productoController.php?op=insertar',
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
              text: 'Producto registrado',
            }).then((result) => {
              if (result.isConfirmed) {
                $('#crearProducto')[0].reset();
                tabla.api().ajax.reload();
              }
            });
            break;
          case '2':
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'El Codigo ya existeEl Codigo ya existe',
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
  
  
  
  /* --------------------------------------------------------------- OBTENER LOS DATOS DEL PRODUCTO --------------------------------------------------------------- */
  
  const rellenarFormulario = async () => {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const Codigo = urlSearchParams.get("Codigo");
  
    if (Codigo) {
      try {
        const response = await fetch(`../../../admin/Controllers/productoController.php?op=obtener&Codigo=${Codigo}`);
        if (response.ok) {
          const datos = await response.json();
  
          // Rellena el formulario con los datos obtenidos
          $("#ECodigo").val(datos.Codigo);
          $("#Enombre").val(datos.nombre);
          $("#Edescripcion").val(datos.descripcion);
          $("#Ecantidad").val(datos.cantidad);
          $("#Eprecio").val(datos.precio);
        } else {
          console.error("Error al obtener los datos del producto");
        }
      } catch (error) {
        console.error("Error en la solicitud AJAX:", error);
      }
    }
  };
  
  rellenarFormulario(); // Llamar la funcion 
  
  /* --------------------------------------------------------------- EDITAR LOS DATOS DEL PRODUCTO --------------------------------------------------------------- */
  $('#producto_update').on('submit', function (event) {
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
        var formData = new FormData($('#producto_update')[0]);
        modificarProducto(formData);
      }
    });
  });
  
  function modificarProducto(formData) {
    $.ajax({
      url: '../../../admin/Controllers/productoController.php?op=editar',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (datos) {
        switch (datos) {
          case '0':
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Error: Cambiar los datos para Actualizar'
            });
            break;
          case '1':
            Swal.fire({
              icon: 'success',
              title: 'Éxito',
              text: 'Producto actualizado exitosamente',
              showConfirmButton: false
            });
            setTimeout(function () {
              window.location.href = 'productos.php'; // Redirige a la lista después de 1 segundo
            }, 1000)
            break;
          case '2':
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
  
  /* --------------------------------------------------------------- ELIMINAR EL PRODUCTO MEDIANTE EL CODIGO --------------------------------------------------------------- */

  $(document).on('click', '.eliminar-producto', function () {
    var cod = $(this).data('cod');
    console.log('Cod del producto: ' + cod);
  
    Swal.fire({
      title: 'Confirmación de Eliminación',
      text: '¿Estás seguro de que deseas eliminar este producto?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        eliminarProducto(cod);
      }
    });
  });
  
  function eliminarProducto(cod) {
    $.ajax({
      url: '../../../admin/Controllers/ProductoController.php?op=eliminar',
      method: 'POST',
      data: { op: 'eliminar', cod: cod },
      success: function (response) {
        if (response === '1') {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo eliminar el producto. Inténtalo de nuevo'
          });
        } else {
          Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Se eliminó el producto correctamente',
            showConfirmButton: false
          });
          setTimeout(function () {
            location.reload();
          }, 1800);
        }
      },
      error: function (error) {
        console.error("Error al eliminar el producto:", error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'No se pudo eliminar el producto. Inténtalo de nuevo'
        });
      }
    });
  }
  
  
  
  
  
  
  
  
  
  
  