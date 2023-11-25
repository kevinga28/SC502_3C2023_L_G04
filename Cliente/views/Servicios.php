<!DOCTYPE html>
<html lang="es">

<head>
    <!-- basic -->
    <meta charset="utf-8">

    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Salon De Belleza</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
    <!-- header -->
    <header>
        <!-- header inicio-->
        <?php
        include 'fragments/header.php'
        ?>

    </header>
    <!-- final header -->

    <!-- banner -->
    <section class="banner_servicios">

        <div class="carousel-inner-servicios">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="text-bg-servicios">
                        <h1>Nuestros Servicios</h1>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- final banner -->

    <!-- servicios -->
    <div id="servicio" class="servicio">
        <div class="container">
            <div class="row">
                <?php
                require_once "../../Admin/config/Conexion.php";
                $conexion = new Conexion();
                $pdo = $conexion->conectar();

                $sql = "SELECT nombre, descripcion, precio FROM tratamiento";
                $result = $pdo->query($sql);

                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <div class="col-md-4">
                            <div id="hover_nuestro_servicio" class="nuestro_servicio_box">
                                <h3><?php echo $row["nombre"]; ?></h3>
                                <p>Precio: ₡ <?php echo number_format($row["precio"], 0, '', ' '); ?></p>

                                <p>Condiciones: <?php echo $row["descripcion"]; ?></p>
                                <div class="boton">
                                    <div class="citas_servicio_icono">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </div>
                                    <div class="citas_servicio_text">
                                        <a href="Cita.php">Citas</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "No se encontraron tratamientos.";
                }
                ?>
            </div>

        </div>
        <!-- final servicios -->
    </div>
    <!-- final servicios -->

    <footer id="contacto">
        <?php
        include 'fragments/footer.php'
        ?>
    </footer>


</body>