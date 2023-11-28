<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salon Evolve - Fecha y Hora</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Admin/Views/plugins/select2/css/select2.min.css">

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <!-- Estilos generales -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/calendar.css">

</head>


<body>
    <!-- header -->
    <header>
        <?php
        include 'fragments/header.php'
        ?>
    </header>
    <!-- final header -->

    <!-- banner -->
    <section class="banner_citas">
        <div class="carousel-inner-citas">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="text-bg-citas">
                        <h1>Agendar Tu Cita</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- final banner -->

    <!-- servicios -->
    <div id="calendario" class="calendario">
        <div class="container">
            <form method="POST" name="modulos_add" id="crearCitaVC">
                <div class="row">

                    <div class="col-md-6 mt-5">

                        <div class="form-group ">
                            <input type="hidden" class="form-control" id="cliente" name="cliente" value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getIdCliente() : ''; ?>">
                        </div>

                        <div class="form-group mb-2">
                            <label for="tratamiento">Tratamiento</label>
                            <select class="select2 select2-hidden-accessible" multiple="multiple" id="tratamiento" name="tratamiento[]" data-placeholder="Seleccionar Tratamiento" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true" required>
                                <!-- Tratamientos cargados desde PHP se insertarán aquí automáticamente -->
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="cedulaEmpleado">Estilista</label>
                            <select class="select2 select2-hidden-accessible" id="cedulaEmpleado" name="cedulaEmpleado" data-placeholder="Seleccionar Estilista" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true" required>
                                <!-- Tratamientos cargados desde PHP se insertarán aquí automáticamente -->
                            </select>
                        </div>

                        <input type="hidden" id="fechaCita" name="fechaCita" readonly>

                        <div class="form-group mb-2">
                            <label for="horaCita">Hora de la Cita</label>
                            <select class="form-control" id="horaCita" name="horaCita" required>
                                <!-- Opciones de horarios cargadas dinámicamente -->
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="duracionTotal">Duración Total</label>
                            <input type="time" class="form-control" id="duracionTotal" name="duracionTotal" readonly>
                        </div>

                        <div class="form-group mb-2">
                            <label for="pagoTotal">Total a Pagar</label>
                            <input type="text" class="form-control" id="pagoTotal" name="pagoTotal" readonly value="₡0">
                            <input type="hidden" id="pagoTotalHidden" name="pagoTotalHidden">
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="text-fecha-hora text-center mt-3 mb-3">
                            <h2>
                                Fecha
                            </h2>
                        </div>
                        <!-- CALENDARIO -->
                        <div class="elegant-calencar d-md-flex">
                            <div class="wrap-header d-flex align-items-center img" style="background-image: url(images/bgCita.jpg);">
                                <p id="reset">Hoy</p>
                                <div id="header" class="p-0">

                                    <div class="head-info">
                                        <div class="head-month"></div>
                                        <div class="head-day"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="calendar-wrap">
                                <div class="w-100 button-wrap">
                                    <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div>
                                    <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div>
                                </div>
                                <table id="calendar">
                                    <thead>
                                        <tr>
                                            <th>Dom</th>
                                            <th>Lun</th>
                                            <th>Mar</th>
                                            <th>Mie</th>
                                            <th>Jue</th>
                                            <th>Vie</th>
                                            <th>Sab</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <style>
                            .circulo {
                                width: 14%;
                                border-radius: 50%;
                                cursor: pointer;
                                -webkit-transition: all 0.2s ease-in;
                                -o-transition: all 0.2s ease-in;
                                transition: all 0.2s ease-in;
                                position: relative;
                                z-index: 0;
                            }
                        </style>
                        <div class="container">
                            <div class="row">
                                <div class="d-flex mt-2 col-md-6">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                                        <circle cx="20" cy="20" r="20" fill="#e13a9d" />
                                    </svg>
                                    <p style="color: #000;" class="ms-2 mt-2">
                                        Este color define el dia de hoy!
                                    </p>
                                </div>


                                <div class="d-flex mt-2 col-md-6">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                                        <circle cx="20" cy="20" r="20" fill="#2a3246" />
                                    </svg>
                                    <p style="color: #000" class="ms-2 mt-2">
                                        Este color es su hora de cita!
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- FIN DEL CALENDARIO -->
                </div>
                <div class="card-footer">
                    <input type="submit" class="btn" value="Agregar Cita" id="btnRegistrarCita" style="background-color: #202126; color: #F7F4ED;"></input>
                </div>

        </div>

        </form>
    </div>
    </div>



    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>


    <!-- SWEETALERT -->
    <script src="../../Admin/Views/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Select2 -->
    <script src="../../Admin/Views/plugins/select2/js/select2.full.min.js"></script>

    <script>
        $(function() {
            // Inicializa Select2 Elements
            $('.select2').select2({
                passive: true
            });
        });
    </script>

    <script src="js/cita.js"></script>
    <script src="js/tratamiento.js"></script>
    <script src="js/main.js"></script>


</body>