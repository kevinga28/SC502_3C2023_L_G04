




const limpiarForms = () => {
    // Selecciona el formulario y restablece su estado
    $('#login')[0].reset();
};




$('#login').on('submit', function (event) {
    event.preventDefault();
    $('#btnlogin').prop('disabled', true);
    var formData = new FormData($('#login')[0]);
    $.ajax({
        //url: 'http://localhost/SC502_3C2023_L_G04/Cliente/Controller/InicioSesionController.php?op=login',
        url: '../../Controllers/loginController.php?op=login',
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
                    limpiarForms();
                    alert('credenciales incorrectas');
                    break;

            }
            $('#btnlogin').removeAttr('disabled');
        },
    });
});