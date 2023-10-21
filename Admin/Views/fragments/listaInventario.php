<?php
// Supongamos que tienes un array de productos con información 
$productos = array(
    array(
        'nombre' => 'Samsung TV',
        'precio' => '$1800',
        'descripcion' => 'Samsung 32" 1080p 60Hz LED Smart HDTV.',
    ),
    array(
        'nombre' => 'Bicycle',
        'precio' => '$700',
        'descripcion' => '26" Mongoose Dolomite Men\'s 7-speed, Navy Blue.',
    ),
    array(
        'nombre' => 'Xbox One',
        'precio' => '$350',
        'descripcion' => 'Xbox One Console Bundle with Halo Master Chief Collection.',
    ),
    array(
        'nombre' => 'PlayStation 4',
        'precio' => '$399',
        'descripcion' => 'PlayStation 4 500GB Console (PS4)',
    ),
    
);
?>


<div class="card-header">
    <h3 class="card-title">Productos Agregados Recientemente</h3>
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
                <div class="product-img">
                    <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                </div>
                <div class="product-info">
                    <a href="javascript:void(0)" class="product-title"><?php echo $producto['nombre']; ?>
                        <span class="badge badge-warning float-right"><?php echo $producto['precio']; ?></span>
                    </a>
                    <span class="product-description">
                        <?php echo $producto['descripcion']; ?>
                    </span>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

<div class="card-footer text-center" style="display: block;">
    <a href="javascript:void(0)" class="uppercase">Ver todos los productos</a>
</div>