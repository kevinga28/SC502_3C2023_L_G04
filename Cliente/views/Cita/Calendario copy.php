<!DOCTYPE html>
<html lang="es">

<head>
    <!-- basic -->
    <meta charset="utf-8">

    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Salon Evolve - Tratamiento</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- CSS DEL CALENDARIO-->
    <link rel="stylesheet" href="css/calendar.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/citaRegistro.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../css/responsive.css">

    <link rel="stylesheet" href="../../../Admin/Views/plugins/select2/css/select2.min.css">

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
            <div class="row">

                <div class="col-md-6">
                    <div class="cuadro-beige2">


                        <div class="form-group">
                            <label for="tratamiento">Tratamiento</label>
                                <select class="select2 select2-hidden-accessible" multiple="multiple" id="tratamiento" name="tratamiento[]" data-placeholder="Seleccionar Tratamiento" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true">
                                    <option value="CorteMujer" data-precio="30" data-duracion="1">Corte Mujer - $30</option>
                                    <option value="LargoLavadoMujer" data-precio="40" data-duracion="1">Largo + Lavado Mujer - $40</option>
                                    <option value="CortoLavadoMujer" data-precio="35" data-duracion="1">Corto + Lavado Mujer - $35</option>
                                    <option value="LargoHombre" data-precio="25" data-duracion="1">Largo Hombre - $25</option>
                                    <option value="CortoHombre" data-precio="20" data-duracion="1">Corto Hombre - $20</option>
                                    <option value="LargoLavadoHombre" data-precio="30" data-duracion="1">Largo + Lavado Hombre - $30</option>
                                    <option value="CortoLavadoHombre" data-precio="25" data-duracion="1">Corto + Lavado Hombre - $25</option>
                                    <option value="NinioNinia" data-precio="15" data-duracion="0.5">Niño - Niña - $15</option>
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estilista">Estilista</label>
                            <select class="select2 select2-hidden-accessible" id="estilista" name="estilista" data-placeholder="Seleccionar Estilista" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true">
                                <option>Carol Mejias</option>
                                <option>Marta Delgado</option>
                                <option>Sofia Vargas</option>
                            </select>
                        </div>


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

                        <div class="row mt-5 ">

                            <div class="col-md-4 horario" style="border-right: 1px solid;">
                                <h3 id="horario-title">Mañana</h3>
                                <div class="opcion">
                                    <a type="button" value="8:00 am">8:00 am</a>
                                </div>
                                <div class="opcion">
                                    <a type="button" value="9:30 am">9:30 am</a>
                                </div>
                                <div class="opcion">
                                    <a type="button" value="10:30 am">10:30 am</a>
                                </div>
                            </div>
                            <div class="col-md-4 horario" style="border-right: 1px solid;">
                                <h3>Tarde</h3>
                                <div class="opcion">
                                    <a type="button" value="2:00 pm">2:00 pm</a>
                                </div>
                                <div class="opcion">
                                    <a type="button" value="3:00 pm">3:00 pm</a>
                                </div>
                                <div class="opcion">
                                    <a type="button" value="5:00 pm">5:00 pm</a>
                                </div>
                            </div>


                            <div class="col-md-4 horario">
                                <h3>Noche</h3>
                                <div class="opcion">
                                    <a type="button" value="6:00 pm">6:00 pm</a>
                                </div>
                                <div class="opcion">
                                    <a type="button" value="7:00 pm">7:00 pm</a>
                                </div>
                                <div class="opcion">
                                    <a type="button" value="8:00 pm">8:00 pm</a>
                                </div>
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
                            <textarea readonly></textarea>
                            <label for="pagoTotal">Total a Pagar</label>
                            <input type="text" class="form-control" id="pagoTotal" name="pagoTotal" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  footer -->
    <footer id="contacto">
        <?php
        include 'fragments/footer.php'
        ?>
    </footer>
    <!-- final footer -->

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../../../Admin/Views/plugins/select2/js/select2.full.min.js"></script>




    <script>
        // Captura el cambio en la selección de tratamientos
        $('#tratamiento').on('change', function() {
            var total = 0;
            // Suma los precios de los tratamientos seleccionados
            $('#tratamiento option:selected').each(function() {
                total += parseInt($(this).data('precio'));
            });
            // Muestra el total en el campo correspondiente
            $('#total').val('$' + total);
        });
    </script>


    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>


</body>