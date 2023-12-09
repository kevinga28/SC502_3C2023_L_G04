<?php
// Tu lógica para conectarte a la base de datos y realizar las consultas
require_once '../../admin/config/global.php';
require_once '../../admin/config/conexion.php';

// Establecer conexión a la base de datos
$conexion = Conexion::conectar();

// Realizar consultas para obtener los datos necesarios
$queryProductosComprados = "SELECT COUNT(IdDetalle) AS ProductosComprados FROM detalle_factura";
$queryCitas = "SELECT COUNT(IdCita) AS TotalCitas FROM cita";
$queryVisitas = "SELECT COUNT(IdCliente) AS TotalClientes FROM cliente";

$resultadoProductos = $conexion->query($queryProductosComprados);
$resultadoCitas = $conexion->query($queryCitas);
$resultadoVisitas = $conexion->query($queryVisitas);

// Obtener los valores de las consultas
$datosProductos = $resultadoProductos->fetch(PDO::FETCH_ASSOC);
$datosCitas = $resultadoCitas->fetch(PDO::FETCH_ASSOC);
$datosVisitas = $resultadoVisitas->fetch(PDO::FETCH_ASSOC);

// Definir los valores obtenidos para usarlos en el diseño
$totalProductos = $datosProductos['ProductosComprados'];
$totalCitas = $datosCitas['TotalCitas'];
$totalVisitas = $datosVisitas['TotalClientes'];
?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Reporte Mensual</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

                <div class="col-md-4">
                    <p class="text-center">
                        <strong>Estadistica</strong>
                    </p>
                    <div class="progress-group">
                        Productos Comprados
                        <span class="float-right"><b><?php echo $totalProductos; ?></b>/200</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: <?php echo ($totalProductos / 200) * 100; ?>%"></div>
                        </div>
                    </div>

                    <div class="progress-group">
                        Citas
                        <span class="float-right"><b><?php echo $totalCitas; ?></b>/400</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger" style="width: <?php echo ($totalCitas / 400) * 100; ?>%"></div>
                        </div>
                    </div>

                    <div class="progress-group">
                        <span class="progress-text">Visitas</span>
                        <span class="float-right"><b><?php echo $totalVisitas; ?></b>/800</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" style="width: <?php echo ($totalVisitas / 800) * 100; ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
