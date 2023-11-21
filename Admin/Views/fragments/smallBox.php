<?php
require_once '../../admin/config/global.php';
require_once '../../admin/config/conexion.php';

$conexion = Conexion::conectar();

$queryProductos = $conexion->query("SELECT count(*) as total FROM producto");
$queryCitas = $conexion->query("SELECT count(*) as total FROM cita");
$queryClientes = $conexion->query("SELECT count(*) as total FROM cliente");
$queryEmpleado = $conexion->query("SELECT count(*) as total FROM empleado");

$resultadoProductos = $queryProductos->fetch(PDO::FETCH_ASSOC);
$resultadoCitas = $queryCitas->fetch(PDO::FETCH_ASSOC);
$resultadoClientes = $queryClientes->fetch(PDO::FETCH_ASSOC);
$resultadoEmpleado = $queryEmpleado->fetch(PDO::FETCH_ASSOC);

$numeroProductos = $resultadoProductos['total'];
$numeroCitas = $resultadoCitas['total'];
$numeroClientes = $resultadoClientes['total'];
$numeroEstilistas = $resultadoEmpleado['total'];
?>


<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-dark">
        <div class="inner">
            <h3><?php echo $numeroCitas; ?></h3>
            <p>Nuevas Citas</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="cita/historialCitas.php" class="small-box-footer">Ver Citas <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-dark">
        <div class="inner">
            <h3><?php echo $numeroClientes; ?></h3>
            <p>Clientes</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="cliente/listaClientes.php" class="small-box-footer">Ver Clientes <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-dark">
        <div class="inner">
            <h3><?php echo $numeroEstilistas; ?></h3>
            <p>Estilistas</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="empleado/listaEmpleado.php" class="small-box-footer">Ver Estilistas <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-dark">
        <div class="inner">
            <h3><?php echo $numeroProductos; ?></h3>
            <p>Inventario</p>
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
        <a href="producto/productos.php" class="small-box-footer">Ver Inventario <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>