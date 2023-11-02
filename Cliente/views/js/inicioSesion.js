




const limpiarForms = () => {
    // Selecciona el formulario y restablece su estado
    $('#usuario_add')[0].reset();
};




$('#login').on('submit', function (event) {

    $('#btnlogin').prop('disabled', true);
    var formData = new FormData($('#login')[0]);
    $.ajax({
        url: '../Controller/InicioSesionController.php?op=login',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {

            switch (datos) {

                case '1':








                    break;

                default :
            }
            $('#btnRegistar').removeAttr('disabled');
        },
    });
});