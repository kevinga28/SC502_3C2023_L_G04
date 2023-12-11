<?php
require_once '../../Admin/Model/Cliente.php';
require_once '../../Admin/config/global.php';
require_once '../../Admin/config/Conexion.php';

// Crear una instancia de la clase Conexion
$conexion = new Conexion();
$pdo = $conexion->conectar();

// Iniciar la sesión
session_start();

// Comprobar si el usuario ha iniciado sesión y si se han almacenado los datos del usuario en la sesión
if (isset($_SESSION['usuarioCliente'])) {
    $usuario = $_SESSION['usuarioCliente'];
    $idCliente = $usuario->getIdCliente();

    // Consultar facturas del cliente
    $queryFacturas = $pdo->prepare("SELECT f.IdFactura, f.IdCita, f.metodoPago, f.pagoTotal
                                    FROM factura f
                                    INNER JOIN cita c ON f.IdCita = c.IdCita
                                    WHERE c.idCliente = :idCliente");
    $queryFacturas->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
    $queryFacturas->execute();
    $facturas = $queryFacturas->fetchAll(PDO::FETCH_ASSOC);
} else {
    $usuario = null;
}

// Cerrar la sesión
if (isset($_GET['cerrar_sesion'])) {
    session_unset();
    session_destroy();
    $usuario = null;
}
?>

<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-9 col-sm-9">
                <nav class="navigation navbar navbar-expand-md navbar-dark ">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarEvolve" aria-controls="navbarEvolve" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarEvolve">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="nosotros.php">Nosotros</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#servicio">Servicios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#estilista">Estilistas</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col logo_section">
                <div class="full">
                    <div class="center-desk">
                        <div class="logo">
                            <a href="index.php"><img src="images/logo.png" alt="#" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
                <ul class="email">
                    <li><a href="#">Telefono: (+506) 7192-3211</a></li>
                    <li><a href="#">Correo: evolvecitas@gmail.com</a></li>
                    <li>
                        <?php
                        if (isset($usuario)) {
                            // El usuario está logueado, mostrar el modal
                        ?>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fas fa-user-circle fa-lg"></i>
                            </a>
                        <?php
                        }
                        ?>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($usuario)) {
    if (basename($_SERVER['PHP_SELF']) === 'index.php') {
?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color: #F7F4ED;">
                    <div class="modal-header">
                        <h4 class="modal-title">Perfil Cliente</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 20px;"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-modal">
                            <?php
                            if (isset($usuario)) {

                                echo '<h6 class="nombre-cliente-modal">Cliente: ' . $usuario->getNombre() . ' ' . $usuario->getApellido() . '</h6>';
                                echo '<p class="correo-cliente-modal">Correo: ' . $usuario->getCorreo() . '</p>';
                                echo '<p class="telefono-cliente-modal">Teléfono: ' . $usuario->getTelefono() . '</p>';
                            } else {
                                echo '<h6 class="nombre-cliente-modal">Cliente: No hay datos registrados</h6>';
                                echo '<p class="correo-cliente-modal">Correo: No hay datos registrados</p>';
                                echo '<p class="telefono-cliente-modal">Teléfono: No hay datos registrados</p>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer" style="justify-content: space-between;">
                        <button type="button" class="btn btn-editar-modal" data-bs-toggle="modal" data-bs-target="#editarModal">Editar</button>

                        <button type="button" class="btn btn-citas-modal" data-bs-toggle="modal" data-bs-target="#facturaModal">Citas Y Facturas</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color: #F7F4ED;">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editarModalLabel">Editar Perfil</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 20px;"></button>
                    </div>

                    <div class="modal-body">
                        <form method="POST" name="cliente_actualizar" id="cliente_actualizar">
                            <div class="row">

                                <div class="form-group">
                                    <input type="hidden" id="EIdCliente" name="IdCliente" value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getIdCliente() : ''; ?>" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="EnombreCliente">Nombre:</label>
                                                <input type="text" id="EnombreCliente" name="nombre" value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getNombre() : ''; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="EapellidoCliente">Apellido:</label>
                                                <input type="text" id="EapellidoCliente" name="apellido" value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getApellido() : ''; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="EcorreoCliente">Correo:</label>
                                        <input type="email" id="EcorreoCliente" name="correo" value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getCorreo() : ''; ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="Econtrasena">Contraseña:</label>
                                        <input type="password" id="Econtrasena" name="contrasena" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="EtelefonoCliente">Teléfono:</label>
                                        <input type="text" id="EtelefonoCliente" name="telefono" value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getTelefono() : ''; ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Eprovincia">Provincia:</label>
                                        <input type="text" id="Eprovincia" name="provincia" value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getProvincia() : ''; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="Edistrito">Distrito:</label>
                                        <input type="text" id="Edistrito" name="distrito" value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getDistrito() : ''; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="Ecanton">Canton:</label>
                                        <input type="text" id="Ecanton" name="canton" value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getCanton() : ''; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="Eotros">Otros:</label>
                                        <input type="text" id="Eotros" name="otros" value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getOtros() : ''; ?>" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" id="EtipoCliente" name="tipoCliente" value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getTipoCliente() : ''; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                    </div>

                    <div class="modal-footer" style="justify-content: space-between;">
                        <button type="button" class="btn btn-citas-modal" data-bs-toggle="modal" data-bs-target="#myModal">Volver</button>
                        <button type="submit" class="btn btn-editar-modal">Guardar Cambios</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- MODAL FACTURA -->
        <div class="modal fade" id="facturaModal" tabindex="-1" aria-labelledby="facturaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color: #F7F4ED;">
                    <div class="modal-header">
                        <h4 class="modal-title" id="facturaModalLabel">Información de Factura</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 20px;"></button>
                    </div>
                    <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                        <?php if (isset($facturas) && count($facturas) > 0) : ?>
                            <table id="tablaFacturas" class="table">
                                <thead>
                                    <tr>
                                        <th>Id Factura</th>
                                        <th>Id Cita</th>
                                        <th>Método de Pago</th>
                                        <th>Pago Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($facturas as $factura) : ?>
                                        <tr>
                                            <td><?php echo $factura['IdFactura']; ?></td>
                                            <td><?php echo $factura['IdCita']; ?></td>
                                            <td><?php echo $factura['metodoPago']; ?></td>
                                            <td><?php echo $factura['pagoTotal']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p>No hay facturas disponibles.</p>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer" style="justify-content: space-between;">
                        <button type="button" class="btn btn-citas-modal" data-bs-toggle="modal" data-bs-target="#myModal">Volver</button>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
?>