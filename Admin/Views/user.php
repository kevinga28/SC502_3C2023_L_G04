<?php
require_once '../Model/Empleado.php';

session_start();


// Verificar si el usuario está autenticado
if (!isset($_SESSION['cedula'])) {
    header("Location: ../views/logueo/logueo.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] == "logout") {
    // Destruir todas las variables de sesión
    $_SESSION = array();

    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    // Destruir la sesión
    session_destroy();

    // Redirigir a la página de inicio de sesión
    header("Location: ../views/logueo/logueo.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evolve | Perfil</title>

    <!-- Google Font: Source Sansa Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/style.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand ">
            <?php
            include 'fragments/navbar.php'
            ?>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 color-custom">

            <?php
            include 'fragments/aside.php'
            ?>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Perfil</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Perfil</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="dist/img/user4-128x128.jpg" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center"><?php echo isset($usuario) ? $usuario->getRol() : ''; ?></h3>

                                    <p class="text-muted text-center"><?php echo isset($usuario) ? $usuario->getNombre() : ''; ?></p>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        </div>
                  
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Mis Datos</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class=" active tab-pane" id="settings">
                                            <form class="form-horizontal" method="POST" name="empleado_update" id="empleado_update"> <!-- Asegúrate de ajustar la acción del formulario -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Nombre">Cedula</label>
                                                            <input type="text" class="form-control" id="Ecedula" name="cedula" placeholder="Cedula" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="Enombre" name="nombre" placeholder="Primer Nombre" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="apellido">Apellido</label>
                                                            <input type="text" class="form-control" id="Eapellido" name="apellido" placeholder="Apellido" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="correo">Correo Electrónico</label>
                                                            <input type="email" class="form-control" id="Ecorreo" name="correo" placeholder="Correo" readonly>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="telefono">Telefono</label>
                                                            <input type="number" class="form-control" id="Etelefono" name="telefono" placeholder="Telefono" required>
                                                        </div>

                                                    </div>
                                                    <div class=" col-md-6">
                                                        <div class="form-group">
                                                            <label for="fechaCita">Provincia</label>
                                                            <input type="text" class="form-control" id="Eprovincia" name="provincia" placeholder="Provincia" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="distrito">Distrito</label>
                                                            <input type="text" class="form-control" id="Edistrito" name="distrito" placeholder="Distrito" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="canton">Canton</label>
                                                            <input type="text" class="form-control" id="Ecanton" name="canton" placeholder="Canton" required>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="otros">Otros</label>
                                                            <input type="text" class="form-control" id="Eotros" name="otros" placeholder="Otras Señales" required>
                                                        </div>



                                                        <div class="form-group">
                                                            <label for="genero">Genero</label>
                                                            <input type="text" class="form-control" id="Egenero" name="genero" placeholder="Genero" readonly>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-10 mt-5">
                                                        <button type="submit" class="btn" style="background-color: #202126; color: #F7F4ED;">Actualizar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </section>
            <!-- /.content -->

        </div>


        <footer class="main-footer no-print">
            <?php
            include 'fragments/footer.php'
            ?>
        </footer>



    </div>


    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- Datatable -->
    <script src="plugins/DataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- SWEETALERT -->
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <script src="plugins/select2/js/select2.full.min.js"></script>
    <script src="logueo/js/logout.js"></script>

    <script>
        const rellenarFormularioDesdeSesion = async () => {
            // Obtener la cédula desde la sesión (asegúrate de ajustar la clave según tu implementación)
            const cedula = '<?php echo isset($_SESSION['cedula']) ? $_SESSION['cedula'] : ''; ?>';

            if (cedula) {
                try {
                    const response = await fetch(`../../admin/Controllers/empleadoController.php?op=obtener&cedula=${cedula}`);
                    if (response.ok) {
                        const datos = await response.json();

                        // Rellena el formulario con los datos obtenidos
                        $("#Ecedula").val(datos.cedula);
                        $("#Eimagen").val(datos.imagen);
                        $("#Egenero").val(datos.genero);
                        $("#Enombre").val(datos.nombre);
                        $("#Eapellido").val(datos.apellido);
                        $("#Ecorreo").val(datos.correo);
                        $("#Etelefono").val(datos.telefono);
                        $("#Eprovincia").val(datos.provincia);
                        $("#Edistrito").val(datos.distrito);
                        $("#Ecanton").val(datos.canton);
                        $("#Eotros").val(datos.otros);
                        $("#Erol").val(datos.rol);

                    } else {
                        console.error("Error al obtener los datos del empleado");
                    }
                } catch (error) {
                    console.error("Error en la solicitud AJAX:", error);
                }
            }
        };

        rellenarFormularioDesdeSesion(); // Llamar la función al cargar la página

        $('#empleado_update').on('submit', function(event) {
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
                    var formData = new FormData($('#empleado_update')[0]);
                    modificarEmpleado(formData);
                }
            });
        });

        function modificarEmpleado(formData) {
            $.ajax({
                url: '../../admin/Controllers/empleadoController.php?op=editar',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos) {
                    switch (datos) {
                        case '1':
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: 'Empleado actualizado exitosamente',
                                showConfirmButton: false
                            });
                            setTimeout(function() {
                                window.location.href = 'user.php'; // Redirige a la lista después de 1 segundo
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
    </script>
</body>

</html>