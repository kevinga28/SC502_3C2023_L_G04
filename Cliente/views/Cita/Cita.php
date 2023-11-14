<!DOCTYPE html>
<html lang="es">

<head>
    <!-- basic -->
    <meta charset="utf-8">

    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Salon Evolve - Fecha y Hora</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../Admin/Views/plugins/select2/css/select2.min.css">

    <!-- style css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- CSS DEL CALENDARIO-->
    <link rel="stylesheet" href="css/calendar.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/citaRegistro.css">

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">


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

        <?php
        include 'fragments/banner.php'
        ?>

    </section>
    <!-- final banner -->

    <!-- servicios -->
    <div id="calendario" class="calendario">
        <div class="container">
            <form method="POST">
                <div class="row">

                    <div class="col-md-6">

                        <div class="cuadro-beige2">
                            <div class="text-fecha-hora text-center mt-3 mb-3">
                                <h2>
                                    Fecha y Hora
                                </h2>
                            </div>

                            <!-- CALENDARIO -->
                            <div class="elegant-calencar d-md-flex">
                                <div class="wrap-header d-flex align-items-center img" style="background-image: url(img/bg.jpg);">
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
                            <!-- FIN DEL CALENDARIO -->

                            <div class="row mt-3 ">

                                <div class="form-group mb-2">
                                    <label for="tratamiento">Tratamiento</label>
                                    <select class="select2 select2-hidden-accessible" multiple="multiple" id="tratamiento" name="tratamiento[]" data-placeholder="Seleccionar Tratamiento" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true" required>
                                        <!-- Tratamientos cargados desde PHP se insertarán aquí automáticamente -->
                                    </select>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="duracionTotal">Duración Total</label>
                                    <input type="time" class="form-control" id="duracionTotal" name="duracionTotal" readonly>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="horaCita">Hora de la Cita</label>
                                    <input type="time" class="form-control" id="horaCita" name="horaCita" required>
                                </div>

                                

                                <div class="form-group mb-2">
                                    <label for="estilista">Estilista</label>
                                    <select class="select2 select2-hidden-accessible" id="cedulaEmpleado" name="cedulaEmpleado" data-placeholder="Seleccionar Estilista" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true" required>
                                        <!-- Estilistas cargados desde PHP se insertarán aquí automáticamente -->
                                    </select>
                                </div>

                                <div class="form-group mb-5">
                                    <label for="pagoTotal">Total a Pagar</label>
                                    <input type="text" class="form-control" id="pagototal" name="pagoTotal" readonly value="₡0">
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div id="titulo" class="titulo">
                            <a href="#"><img src="../images/logo.png" alt="#" class="imag_medio" /></a>
                        </div>

                        <div class="bloque-gris">
                            <p>Servicios</p>
                            <div class="cuadro-blanco">
                                <textarea placeholder="Tratamientos" readonly></textarea>
                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn" value="Agendar Cita" id="btnRegistrarCita" style="background-color: #202126; color: #F7F4ED;"></input>
                            </div>

                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>



    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>

    <!-- SWEETALERT -->
    <script src="../../../Admin/Views/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Select2 -->
    <script src="../../../Admin/Views/plugins/select2/js/select2.full.min.js"></script>


    <script>
        $(function() {
            // Inicializa Select2 Elements
            $('.select2').select2({
                passive: true
            });
        });
    </script>

    <script src="../cita/js/cita.js"></script>
    <script src="../cita/js/tratamiento.js"></script>


</body>