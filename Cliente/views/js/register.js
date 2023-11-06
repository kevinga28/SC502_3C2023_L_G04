
const limpiarForms = () => {
    // Selecciona el formulario y restablece su estado
    $('#usuario_add')[0].reset();
};




$('#usuario_add').on('submit', function (event) {
    event.preventDefault();
    $('#btnlogin').prop('disabled', true);
    var formData = new FormData($('#usuario_add')[0]);
    $.ajax({
        //url: 'http://localhost/SC502_3C2023_L_G04/Cliente/Controller/InicioSesionController.php?op=login',
        url: '../Controller/UsuarioController.php?op=insertar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            switch (datos) {
                case '1':
                    alert('Logeado');
                    limpiarForms();
                    window.location.href = "../index.php";

                    break;
                case '2':
                    alert('credenciales incorrectas');

                    break;
                case '3':
                    alert('correo ya existente')

            }
            $('#btnRegistar').removeAttr('disabled');
        },
    });
});