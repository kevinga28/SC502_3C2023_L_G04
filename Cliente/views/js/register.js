
const limpiarForms = () => {
    // Selecciona el formulario y restablece su estado
    $('#usuario_add')[0].reset();
};




$('#usuario_add').on('submit', function (event) {
    event.preventDefault();
    $('#btnlogin').prop('disabled', true);
    var formData = new FormData($('#usuario_add')[0]);
    $.ajax({
        //url: 'http://localhost/SC502_3C2023_L_G04/Cliente/Controller/UsuarioController.php?op=login',
        url: '../../Controller/UsuarioController.php?op=insertar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            switch (datos) {
                case '1':
                    alert('correo ya existente')
                    limpiarForms();


                    break;
                case '2':
                    alert('la contraeña debe contener al menos 8 caracteres');
                    limpiarForms();

                    break;
                case '3':

                    alert('Usuario Registrado');
                    limpiarForms();
                    window.location.href = "../index.php";
                    break;
                case '4':
                    alert('error')

            }
            $('#btnRegistar').removeAttr('disabled');
        },
    });
});