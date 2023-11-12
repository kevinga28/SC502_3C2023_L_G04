
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
                    Swal.fire({
                        icon: 'error',
                        title: 'Correo ya registrado',
                        text: 'Ya existe un usuario con ese correo electronico.',});


                    limpiarForms();


                    break;
                case '2':
                    Swal.fire({
                        icon: 'error',
                        title: 'Contraseña invalida',
                        text: 'la contraseña debe tener al menos 8 caracteres.',});


                    limpiarForms();

                    break;
                case '3':



                    limpiarForms();
                    window.location.href = "../../index.php";
                    break;
                case '4':
                    alert('error')

            }
            $('#btnRegistar').removeAttr('disabled');
        },
    });
});