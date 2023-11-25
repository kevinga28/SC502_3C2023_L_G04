function limpiarForms() {
    $('#factura_add').trigger('reset');
    $('#factura_update').trigger('reset');
}

/* ---------------------------------------------------------------LISTAR LAS FACTURAS--------------------------------------------------------------- */
function listarFacturas() {
    tabla = $('#tblistadoFactura').dataTable({
        aProcessing: true, //actiavmos el procesamiento de datatables
        aServerSide: true, //paginacion y filtrado del lado del serevr
        dom: 'Bfrtip', //definimos los elementos del control de tabla
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        ajax: {
            url: '../../../admin/Controllers/facturaController.php?op=listaTabla',
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
            { data: "0" },  // ID de la factura
            { data: "1" },  // ID de la cita
            { data: "2" },  // Nombre
            { data: "3" },  // Apellido
            { data: "4" },  // Tratamiento
            { data: "5" },  // Producto
            { data: "6" },  // Método de pago
            { data: "7" },  // Pago total
            {
                // Última columna con botones
                data: null,
                render: function (data, type, row) {
                    return '<a type="button" class="btn btn-danger float-right eliminar-factura" data-id="' + data[0] + '"><i class="fas fa-trash"></i> Eliminar</a>' +
                        '<a id="modificarFactura" class="editar-btn btn btn-success float-right" style="margin-right: 8px;" href="editarFactura.php?IdFactura=' + data[0] + '"><i class="fas fa-pencil-alt"></i> Editar</a>' +
                        '<a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verFactura.php?IdFactura=' + data[0] + '"><i class="fas fa-eye"></i> Ver</a>';
                }
            }
        ]
    });
}
$(function () {
    listarFacturas();
});


/* ---------------------------------------------------------------CREAR LAS FACTURAS--------------------------------------------------------------- */
$('#crearFactura').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistrar').prop('disabled', true);
    var formData = new FormData($('#crearFactura')[0]);
    $.ajax({
        url: '../../../admin/Controllers/facturaController.php?op=insertar',
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
                        text: 'Factura registrada',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#crearFactura')[0].reset();
                            tabla.api().ajax.reload();
                        }
                    });
                    break;
                case '2':
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'La Factura ya existe. Corrija e inténtelo nuevamente.',
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

/* ---------------------------------------------------------------BUSCAR UNA CITA --------------------------------------------------------------- */
$(document).ready(function () {
    function cargarCita() {
        $.ajax({
            url: '../../../admin/Controllers/citaController.php?op=cargarCita',
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                var selectedCita = $('#citas, #Ecitas');
                selectedCita.empty();

                selectedCita.append('<option value="" disabled selected>Seleccionar Cita</option>');

                if (data && data.length > 0) {
                    $.each(data, function (index, cita) {
                        selectedCita.append('<option value="' + cita.IdCita + '">' + cita.IdCita + ' ' + cita.nombreCliente + ' ' + cita.apellidoCliente + ' ' + cita.fechaCita + '</option>');
                    });

                    selectedCita.change(function () {
                        var selectedCitaId = $(this).val();

                        var selectedCita = data.find(function (cita) {
                            return cita.IdCita == selectedCitaId;
                        });

                        if (selectedCita) {
                            $("#nombre, #Enombre").val(selectedCita.nombreCliente);
                            $("#apellido, #Eapellido").val(selectedCita.apellidoCliente);
                            $("#correo, #Ecorreo").val(selectedCita.correoCliente);
                            $("#tratamiento, #Etratamiento").val(selectedCita.tratamientos);
                            $("#estilista,  #Eestilista").val(selectedCita.nombreEmpleado + " " + selectedCita.apellidoEmpleado);
                            $("#fechaCita,  #EfechaCita").val(selectedCita.fechaCita);
                            $("#horaCita, #EhoraCita").val(selectedCita.horaCita);
                            $("#pagoTratamiento, #EpagoTratamiento").val(selectedCita.pagoTotal);
                        }
                    });
                }
            },
            error: function () {
                console.log('Error al cargar citas');
            }
        });
    }
    $(document).ready(function () {
        cargarCita();
    });
});

/* ---------------------------------------------------------------TOTAL--------------------------------------------------------------- */

$(document).ready(function () {
    function actualizarTotalProductos() {
        var totalProductos = 0;

        if ($('#producto option:selected, #Eproducto option:selected').length === 0) {
            totalProductos = parseFloat($('#pagoTratamiento, #EpagoTratamiento').val()) || 0;
        } else {
            $('#producto option:selected, #Eproducto option:selected').each(function () {
                var precio = parseFloat($(this).data('precio')) || 0;
                var cantidad = parseInt($('#cantidad, #Ecantidad').val()) || 1;
                totalProductos += precio * cantidad;
            });
        }

        $('#pagoProductos, #EpagoProductos').val(totalProductos.toFixed(2));
        return totalProductos;
    }

    function actualizarTotal() {
        var totalProductos = actualizarTotalProductos();
        var totalFinal = totalProductos;

        $('#pagoTotal, #pagoTotalHidden, #EpagoTotal, #EpagoTotalHidden').val(totalFinal.toFixed(2));
    }

    // Detectar cambios en la selección de productos, en la cantidad y en el total de tratamiento
    $('#producto, #cantidad, #pagoTratamiento, #Eproducto, #Ecantidad, #EpagoTratamiento').on('change', function () {
        actualizarTotal(); // Actualizar el total al detectar cambios
    });
});
/* ---------------------------------------------------------------BUSCAR UN PRODUCTO --------------------------------------------------------------- */

$(document).ready(function () {
    $.ajax({
        url: '../../../admin/Controllers/productoController.php?op=lista',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data.length > 0) {
                var select = $('#producto, #Eproducto');

                select.empty();

                $.each(data, function (index, producto) {
                    var option = $('<option>', {
                        value: producto.Codigo,
                        'data-precio': producto.precio,
                    }).text(producto.nombre + ' - ₡' + producto.precio);

                    select.append(option);
                });
            } else {
                console.log('No se encontraron productos.');
            }
        },
        error: function (error) {
            console.log('Error en la solicitud AJAX: ' + error.responseText);
        }
    });
});


/* ---------------------------------------------------------------RELLANAR FORMULARIO DE FACTURA PARA EDICIÓN--------------------------------------------------------------- */

const rellenarFormularioFactura = async () => {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const idFactura = urlSearchParams.get("IdFactura");

    if (idFactura) {
        try {
            const response = await fetch(`../../../admin/Controllers/facturaController.php?op=obtener&IdFactura=${idFactura}`);
            if (response.ok) {
                const datos = await response.json();

                $("#Enombre").val(datos.nombreCliente);
                $("#Eapellido").val(datos.apellidoCliente);
                $("#Ecorreo").val(datos.correoCliente);
                $("#Etratamiento").val(datos.nombresTratamientos);
                $("#Eestilista").val(datos.nombreEstilista + " " + datos.apellidoEstilista);
                $("#EfechaCita").val(datos.fechaCita);
                $("#EhoraCita").val(datos.horaCita);
                $("#Eproducto").val(datos.nombresProductos);
                $("#Ecantidad").val(datos.cantidad);
                $("#EmetodoPago").val(datos.metodoPago);
                $("#EpagoTotal").val(datos.pagoTotal);

            } else {
                console.error("Error al obtener los datos de la factura");
            }
        } catch (error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    }
};

rellenarFormularioFactura();

/* ---------------------------------------------------------------EDITAR LOS DATOS DE LA FACTURA--------------------------------------------------------------- */
$('#factura_update').on('submit', function (event) {

    event.preventDefault();

    var urlParams = new URLSearchParams(window.location.search);
    var IdFactura = urlParams.get('IdFactura');
   
    Swal.fire({
        title: 'Confirmación de Modificación',
        text: '¿Desea modificar los datos de la Factura?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, modificar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            var formData = new FormData($('#factura_update')[0]);
            formData.append('IdFactura', IdFactura);
            modificarFactura(formData);
        }
    });
});

function modificarFactura(formData) {
    $.ajax({
        url: '../../../admin/Controllers/facturaController.php?op=editar',
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
                        text: 'Factura actualizada exitosamente',
                        showConfirmButton: false
                    });
                    setTimeout(function () {
                        window.location.href = 'listaFactura.php'; // Redirige a la lista después de 1 segundo
                    }, 1000)
                    break;
                case '2':
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error: Cambiar los datos para actualizar'
                    });
                    break;
                case '3':
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error: No se pudo editar la Factura.'
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
/* ---------------------------------------------------------------ELIMINAR LA FACTURA MEDIANTE EL ID--------------------------------------------------------------- */

// Eliminar una factura
$(document).on('click', '.eliminar-factura', function () {
    var id = $(this).data('id');

    Swal.fire({
        title: 'Confirmación de Eliminación',
        text: '¿Estás seguro de que deseas eliminar esta Factura?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarFactura(id);
        }
    });
});


function eliminarFactura(id) {
    $.ajax({
        url: '../../../admin/Controllers/facturaController.php?op=eliminar',
        method: 'POST',
        data: { op: 'eliminar', id: id },
        success: function (response) {
            switch (response) {
                case '1':
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Factura eliminada exitosamente',
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
                        text: 'No se pudo eliminar la Factura.'
                    });
                    break;
                default:
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error inesperado. No se pudo eliminar la Factura.'
                    });
            }
        },
        error: function (error) {
            console.error("Error al eliminar la Factura:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo eliminar la Factura. Inténtalo de nuevo'
            });
        }
    });
}
