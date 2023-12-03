<div class="col-md-4">
    <?php
    $query_reporte = "
        SELECT c.IdCliente, CONCAT(cli.nombre, ' ', cli.apellido) AS nombre_cliente, COUNT(c.IdCita) AS total_citas
        FROM cita c
        INNER JOIN cliente cli ON c.IdCliente = cli.IdCliente
        GROUP BY c.IdCliente
        ORDER BY total_citas DESC
        LIMIT 1
    ";

    $stmt = $conexion->prepare($query_reporte);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    $nombreCliente = $data['nombre_cliente'];
    $totalCitas = $data['total_citas'];
    ?>

    <div class="card">
        <div class="card-header border-0">
            <div class="card-tools">
                <div class="btn-group ml-4">
                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52" aria-expanded="true">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu" x-placement="bottom-start">
                        <a href="?tipo=semana" class="dropdown-item">Semana</a>
                        <a href="?tipo=mes" class="dropdown-item">Mes</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Clientes Frecuentes</h3>
                <a href="javascript:void(0);">Ver Reporte</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="text-bold text-lg"><?php echo $nombreCliente; ?></span>
                    <span>Cliente Frecuente</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-bold text-lg"><?php echo $totalCitas; ?></span>
                    <span>Total de Citas</span>
                </p>
            </div>

            <div class="position-relative mb-4">
                <canvas id="total-citas" height="170px"></canvas>
            </div>
        </div>
    </div>
</div>





<div class="col-md-4">
    <?php
  
    // Obtener el tipo de reporte seleccionado
    $tipoReporte = isset($_GET['tipo']) ? $_GET['tipo'] : 'semana'; // Si no se proporciona un tipo, se asume 'semana'

    // Construir la consulta según el tipo de reporte seleccionado
    if ($tipoReporte === 'semana') {
        $query_reporte = "
        SELECT YEAR(c.fechaCita) AS year, WEEK(c.fechaCita) AS week_number, SUM(f.pagoTotal) AS total_pagos
        FROM factura f
        INNER JOIN cita c ON f.IdCita = c.IdCita
        GROUP BY year, week_number
        ORDER BY year, week_number;
    ";
    } else {
        $query_reporte = "
        SELECT YEAR(c.fechaCita) AS year, MONTH(c.fechaCita) AS month_number, SUM(f.pagoTotal) AS total_pagos
        FROM factura f
        INNER JOIN cita c ON f.IdCita = c.IdCita
        GROUP BY year, month_number
        ORDER BY year, month_number;
    ";
    }

    $result_reporte = $conexion->query($query_reporte);

    // Inicialización de arreglos para los datos del gráfico
    $labels = [];
    $data = [];

    if ($result_reporte && $result_reporte->rowCount() > 0) {
        while ($row = $result_reporte->fetch(PDO::FETCH_ASSOC)) {
            if ($tipoReporte === 'semana') {
                $labels[] = "Año " . $row["year"] . ", Semana " . $row["week_number"];
            } else {
                $labels[] = "Año " . $row["year"] . ", Mes " . $row["month_number"];
            }
            $data[] = $row["total_pagos"];
        }
    }
    ?>

    <div class="card">
        <div class="card-header border-0">
            <div class="card-tools">
                <div class="btn-group ml-4">
                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52" aria-expanded="true">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu" x-placement="bottom-start">
                        <a href="?tipo=semana" class="dropdown-item">Semana</a>
                        <a href="?tipo=mes" class="dropdown-item">Mes</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Reporte de Pagos <?php echo ucfirst($tipoReporte); ?></h3>
                <a href="javascript:void(0);" onclick="showReport('<?php echo $tipoReporte; ?>')">Ver Reporte</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="text-bold text-lg">₡ <?php echo $data[0]; ?></span>
                    <span>Pago Total </span>
                </p>

            </div>

            <div class="position-relative mb-4">
                <canvas id="reporte-ventas" height="170px"></canvas>
            </div>

        </div>
    </div>
</div>




<div class="col-md-4">
    <?php
    $query_rentabilidad = "
        SELECT t.IdTratamiento, t.nombre AS nombre_tratamiento, 
               SUM(t.precio) AS ingresos_totales,
               COUNT(c.IdCita) AS total_citas,
               SUM(t.precio) - COUNT(c.IdCita) * t.precio AS rentabilidad
        FROM tratamiento t
        LEFT JOIN cita_tratamiento ct ON t.IdTratamiento = ct.IdTratamiento
        LEFT JOIN cita c ON ct.IdCita = c.IdCita
        GROUP BY t.IdTratamiento
    ";

    $stmt_rentabilidad = $conexion->prepare($query_rentabilidad);
    $stmt_rentabilidad->execute();

    $labels4 = [];
    $ingresos4 = [];
    $citas4 = [];
    $rentabilidad4 = [];

    if ($stmt_rentabilidad->rowCount() > 0) {
        while ($row = $stmt_rentabilidad->fetch(PDO::FETCH_ASSOC)) {
            $labels4[] = $row['nombre_tratamiento'];
            $ingresos4[] = $row['ingresos_totales'];
            $citas4[] = $row['total_citas'];
            $rentabilidad4[] = $row['rentabilidad'];
        }
    }
    ?>



<div class="card">
        <div class="card-header border-0">
            <div class="card-tools">
                <div class="btn-group ml-4">
                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52" aria-expanded="true">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu" x-placement="bottom-start">
                        <a href="?tipo=semana" class="dropdown-item">Semana</a>
                        <a href="?tipo=mes" class="dropdown-item">Mes</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Reporte de Rentabilidad Tratamientos </h3>
                <a href="javascript:void(0);" onclick="showReport('<?php echo $tipoReporte; ?>')">Ver Reporte</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    
                </p>

            </div>

            <div class="position-relative mb-4">
            <canvas id="rentabilidad-tratamientos" height="170px"></canvas>
            </div>

        </div>
    </div>
</div>


