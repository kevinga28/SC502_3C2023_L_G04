
const limpiarForms = () => {
    // Selecciona el formulario y restablece su estado
    $('#usuario_add')[0].reset();
};




$('#usuario_add').on('submit', function (event) {
    $('#btnRegistar').prop('disabled', true);
    var formData = new FormData($('#usuario_add')[0]);
    $.ajax({
        url: '../Controller/UsuarioController.php?op=insertar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {

            switch (datos) {

                case '1':


                    break;


            }
            $('#btnRegistar').removeAttr('disabled');
        },
    });
});