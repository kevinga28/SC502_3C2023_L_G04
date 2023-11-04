function limpiarForms() {
    $('#modulos_add').trigger('reset');
    $('#modulos_update').trigger('reset');
  }
  
  /* --------------------------------------------------------------- LISTAR LOS PRODUCTOS --------------------------------------------------------------- */
  function listarProductosTodos() {
    tabla = $('#tbllistado').dataTable({
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
            return '<a type="button" class="btn btn-danger float-right eliminar-producto" data-codigo="<?= $codigo ?>"><i class="fas fa-trash"></i> Eliminar</a>' +
              '<a id="editarProducto" class="editar-btn btn btn-success float-right" style="margin-right: 8px;" href="editarProducto.php?codigo=' + data[0] + '"><i class="fas fa-pencil-alt"></i>Editar</a>' +
              '<a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verProducto.php?codigo=' + data[0] + '"><i class="fas fa-eye"></i>Ver</a>';
          }
        }
      ]
    });
  }
  $(function () {
  
    listarProductosTodos();
  });
  
  /* --------------------------------------------------------------- CREAR LOS PRODUCTOS --------------------------------------------------------------- */
  
  $('#crearProducto').on('submit', function (event) {
    event.preventDefault();
    console.log('Formulario enviado');
    $('#btnRegistrar').prop('disabled', true);
    var formData = new FormData($('#crearProducto')[0]);
    console.log('Datos del producto:', formData);
    $.ajax({
      url: '../../../admin/Controllers/productoController.php?op=insertar',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (datos) {
        console.log('Respuesta del servidor:', datos);
        $('#btnRegistrar').removeAttr('disabled');
      },
    });
  });
  
  
  
  /* --------------------------------------------------------------- OBTENER LOS DATOS DEL PRODUCTO --------------------------------------------------------------- */
  
  const rellenarFormulario = async () => {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const codigo = urlSearchParams.get("codigo");
  
    if (codigo) {
      try {
        const response = await fetch(`../../../admin/Controllers/productoController.php?op=obtener&codigo=${codigo}`);
        if (response.ok) {
          const datos = await response.json();
  
          // Rellena el formulario con los datos obtenidos
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
    bootbox.confirm('¿Desea modificar los datos?', function (result) {
      if (result) {
        var formData = new FormData($('#producto_update')[0]);
        $.ajax({
          url: '../../../admin/Controllers/productoController.php?op=editar',
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
                toastr.success('Producto actualizado exitosamente');
                tabla.api().ajax.reload();
                limpiarForms();
                $('#formulario_update').hide();
                $('#formulario_add').show();
                break;
              case '2':
                toastr.error('Error: codigo no se puede editar.');
                break;
            }
          },
        });
      }
    });
  });
  
  /* --------------------------------------------------------------- ELIMINAR EL PRODUCTO MEDIANTE EL CODIGO --------------------------------------------------------------- */
  
  $('.eliminar-producto').on('click', function() {
    var codigo = $(this).data('codigo'); // Obtiene el ID del cliente desde el atributo de datos
  
    if (codigo !== undefined) {
        if (confirm("¿Estás seguro de que deseas eliminar este produucto?")) {
            // Realiza una solicitud al controlador para eliminar el codigo
            fetch(`controlador.php?op=eliminar&codigo=${codigo}`, {
                method: 'POST' // Utiliza POST u otro método según tu configuración
            })
            .then(response => {
                if (response.ok) {
                    alert("Producto eliminado exitosamente");
                    // Puedes realizar acciones adicionales, como actualizar la vista o la lista de clientes en la página.
                } else {
                    alert("No se pudo eliminar el producto. Inténtalo de nuevo.");
                }
            })
            .catch(error => {
                console.error("Error al eliminar el producto:", error);
            });
        }
    }
  });
  