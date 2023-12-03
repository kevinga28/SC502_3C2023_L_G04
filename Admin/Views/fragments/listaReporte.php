<?php
require_once '../../admin/config/global.php';
require_once '../../admin/config/conexion.php';

$conexion = Conexion::conectar();

// Consulta para obtener toda la información de productos agregados 
$queryProductos = $conexion->query("SELECT nombre, cantidad, codigo FROM producto");
$productos = $queryProductos->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="card-header">
    <h3 class="card-title">Reportes</h3>
    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<div class="card-body p-0" style="display: block;">
    <ul class="products-list product-list-in-card pl-2 pr-2">
        <?php foreach ($productos as $producto) { ?>
            <li class="item">
                <div class="product-info">
                    <a href="" class="product-title">
                        <?php echo $producto['nombre']; ?>
                        <span class="badge badge-info float-right"><?php echo $producto['codigo']; ?></span>
                    </a>
                    <span class="product-description">
                        Cantidad: <?php echo $producto['cantidad']; ?>
                    </span>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

<div class="card-footer text-center" style="display: block;">
    <a href="producto/productos.php" class="uppercase">Ver todos </a>
</div>
