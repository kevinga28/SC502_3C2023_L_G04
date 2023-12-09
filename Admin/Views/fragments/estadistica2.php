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
<div class="col-md-4">
    <?php
    // Obtener la lista de productos
    $query_productos = "SELECT p.Codigo, p.nombre
    FROM producto p
    INNER JOIN detalle_factura df ON p.Codigo = df.CodigoProducto";

    $stmt_productos = $conexion->prepare($query_productos);
    $stmt_productos->execute();

    $productos = $stmt_productos->fetchAll(PDO::FETCH_ASSOC);

    // Obtener el producto seleccionado (por defecto, todos)
    $productoSeleccionado = isset($_GET['producto']) ? $_GET['producto'] : 'todos';

    // Construir la consulta según la selección del usuario
    if ($productoSeleccionado === 'todos') {
        $query_ventas_productos = "
            SELECT p.nombre AS nombre_producto, SUM(df.Cantidad) AS cantidad_vendida
            FROM producto p
            INNER JOIN detalle_factura df ON p.Codigo = df.CodigoProducto
            INNER JOIN factura f ON df.IdFactura = f.IdFactura
            GROUP BY p.Codigo
        ";
    } else {
        $query_ventas_productos = "
            SELECT p.nombre AS nombre_producto, SUM(df.Cantidad) AS cantidad_vendida
            FROM producto p
            INNER JOIN detalle_factura df ON p.Codigo = df.CodigoProducto
            INNER JOIN factura f ON df.IdFactura = f.IdFactura
            WHERE p.Codigo = :producto
            GROUP BY p.Codigo
        ";
    }

    $stmt_ventas_productos = $conexion->prepare($query_ventas_productos);

    // Bind para el parámetro :producto si no es 'todos'
    if ($productoSeleccionado !== 'todos') {
        $stmt_ventas_productos->bindParam(':producto', $productoSeleccionado, PDO::PARAM_INT);
    }

    $stmt_ventas_productos->execute();

    $labels_productos = [];
    $data_ventas_productos = [];

    if ($stmt_ventas_productos->rowCount() > 0) {
        while ($row = $stmt_ventas_productos->fetch(PDO::FETCH_ASSOC)) {
            $labels_productos[] = $row['nombre_producto'];
            $data_ventas_productos[] = $row['cantidad_vendida'];
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
                <h3 class="card-title">Productos Vendidos</h3>
                <a href="javascript:void(0);">Ver Reporte</a>
            </div>
        </div>
        <div class="card-body">

            <form method="GET" action="">
                <label for="producto">Seleccione un producto:</label>
                <div class="input-group mb-3">
    <select class="custom-select" name="producto" id="producto">
        <option value="todos">Todos</option>
        <?php foreach ($productos as $producto) : ?>
            <option value="<?php echo $producto['Codigo']; ?>" <?php echo ($productoSeleccionado == $producto['Codigo']) ? 'selected' : ''; ?>>
                <?php echo $producto['nombre']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <div class="input-group-append">
        <label class="input-group-text" for="producto">Producto</label>
        <button type="submit">Ver producto</button>
    </div>
</div>

            </form>

            <div class="position-relative mb-4">
                <canvas id="productos-vendidos" height="170px"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4">
    <?php
    // Obtener los valores mínimos y máximos del rango de precio
    $minPrecio = isset($_GET['minPrecio']) ? $_GET['minPrecio'] : '';
    $maxPrecio = isset($_GET['maxPrecio']) ? $_GET['maxPrecio'] : '';

    // Construir la parte de la consulta según los valores ingresados
    $whereRangoPrecio = '';
    if ($minPrecio !== '' && $maxPrecio !== '') {
        $whereRangoPrecio = " AND t.precio BETWEEN :minPrecio AND :maxPrecio";
    }

    // Consulta para obtener los tratamientos filtrados por rango de precio
    $query_tratamientos_filtrados = "
    SELECT 
        t.precio AS rango_precio,
        COUNT(ct.IdCita) AS cantidad_vendida
    FROM tratamiento t
    LEFT JOIN cita_tratamiento ct ON t.IdTratamiento = ct.IdTratamiento
    LEFT JOIN cita c ON ct.IdCita = c.IdCita
    WHERE 1 $whereRangoPrecio
    GROUP BY t.precio
";

    $stmt_tratamientos_filtrados = $conexion->prepare($query_tratamientos_filtrados);

    // Bind para el parámetro :minPrecio
    if ($minPrecio !== '' && $maxPrecio !== '') {
        $stmt_tratamientos_filtrados->bindParam(':minPrecio', $minPrecio, PDO::PARAM_INT);
        $stmt_tratamientos_filtrados->bindParam(':maxPrecio', $maxPrecio, PDO::PARAM_INT);
    }

    $stmt_tratamientos_filtrados->execute();

    $labels_tratamientos_filtrados = [];
    $data_tratamientos_filtrados = [];

    if ($stmt_tratamientos_filtrados->rowCount() > 0) {
        while ($row = $stmt_tratamientos_filtrados->fetch(PDO::FETCH_ASSOC)) {
            $labels_tratamientos_filtrados[] = $row['rango_precio'];
            $data_tratamientos_filtrados[] = $row['cantidad_vendida'];
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
                <h3 class="card-title">Tratamientos Vendidos</h3>
                <a href="javascript:void(0);">Ver Reporte</a>
            </div>
        </div>
        <div class="card-body">

        <form id="rangoForm">
                <div>
                    <label class="form-label" for="minPrecio">Precio Mínimo:</label>
                    <input type="number" name="minPrecio" id="minPrecio" value="<?php echo $minPrecio; ?>" class="form-control">

                    <label for="maxPrecio">Precio Máximo:</label>
                    <input type="number" name="maxPrecio" id="maxPrecio" value="<?php echo $maxPrecio; ?>" class="form-control">
                    <button type="submit"  class="btn btn-primary" >Actualizar Gráfico</button>
                </div>
            </form>

          <div class="position-relative mb-4">
            <canvas id="tratamientos-vendidos-filtrados"  height="170px"></canvas>
          </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Función para obtener los datos y actualizar el gráfico
        function updateChart() {
            // Obtener los valores ingresados por el usuario
            var minPrecio = $('#minPrecio').val();
            var maxPrecio = $('#maxPrecio').val();

            // Realizar la solicitud AJAX
            $.ajax({
                url: './estadistica2.php',
                method: "GET",
                data: { minPrecio: minPrecio, maxPrecio: maxPrecio },
                success: function (data) {
                    var newData = JSON.parse(data);

                    if (newData.labels && newData.data) {
                        myChart.data.labels = newData.labels;
                        myChart.data.datasets[0].data = newData.data;
                        myChart.update();
                    } else {
                        console.error("Error en el formato de los datos recibidos.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                }
            });
        }

        // Llamamos a la función al cargar la página
        updateChart();

        // Configuramos el evento submit para el formulario
        $('#rangoForm').submit(function (event) {
            event.preventDefault();  // Evitar que el formulario se envíe y recargue la página
            updateChart();
        });
    });

</script>
    
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


