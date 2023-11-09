<?php
    require_once '../Model/Producto.php';

    switch ($_GET["op"]) {
        
        case 'listaProducto':
            $producto = new Producto();
            $productos = $producto->listarProductos();
            $data = array();
            foreach ($productos as $articulo) {
                $data[] = array(
                    "0" => $articulo->getCodigo(),
                    "1" => $articulo->getNombre(),
                    "2" => $articulo->getDescripcion(),
                    "3" => $articulo->getCantidad(),
                    "4" => $articulo->getPrecio(),
                );
            }

            $resultados = array(
                "sEcho" => 1, ##informacion para datatables
                "iTotalRecords" =>count($data), ## total de registros al datatable
                "iTotalDisplayRecords" => count($data), ## enviamos el total de registros a visualizar
                "aaData" => $data
            );
            echo json_encode($resultados);
        break;

        case 'insertar':
            $Codigo = isset($_POST["Codigo"]) ? trim($_POST["Codigo"]) : "";
            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
            $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
            $cantidad = isset($_POST["cantidad"]) ? trim($_POST["cantidad"]) : "";
            $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";

            $producto = new Producto();

            $producto->setCodigo($Codigo);
            $encontrado = $producto->verificarProducto();
            if ($encontrado == false) {   
                $producto->setCodigo($Codigo);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setCantidad($cantidad);
                $producto->setPrecio($precio);
                $producto->insertar();
                if ($producto->verificarProducto()) {
                    echo 1; 
                } else {
                    echo 2;
                }
            } else {
                echo 3;
            }
        break;

        case 'verificar_producto':
            $Codigo = isset($_POST["Codigo"]) ? trim($_POST["Codigo"]) : "";
            $producto = new Producto();
            $producto->setProducto($producto);
            $encontrado = $producto->verificarProducto();
            if ($encontrado != null) {
                echo 1;
            }else{
                echo 0;
            }
        break;

        case 'editar':
            $Codigo = isset($_POST["Codigo"]) ? trim($_POST["Codigo"]) : "";
            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
            $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
            $cantidad = isset($_POST["cantidad"]) ? trim($_POST["cantidad"]) : "";
            $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";

            $producto = new Producto();
            $encontrado = $producto->verificarProducto();

            if ($encontrado == false) {
                $producto->setCodigo($Codigo);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setCantidad($cantidad);
                $producto->setPrecio($precio);

                if ( $producto->actualizarProducto()) {
                    echo 1; 
                } else {
                    echo 2; 
                }
            } else {
                echo 3; 
            }

        break;

        case 'obtener':
            if (isset($_GET['Codigo'])) {
                $Codigo = isset($_GET['Codigo']) ? intval($_GET['Codigo']) : null;
                $producto = Producto::obtenerProductoCodigo($Codigo);
    
                if ($producto) {
                    // Devuelve los datos del producto en formato JSON
                    echo json_encode($producto);
                } else {
                    echo json_encode(["error" => "No se encontró el producto"]);
                }
            } else {
                echo json_encode(["error" => "Codigo del producto no proporcionado"]);
            }
            break;

        case 'eliminar':
            if (isset($_POST['Codigo'])) {
                $Codigo = intval($_POST['Codigo']);
                $producto = new Producto();
                $producto->setCodigo($Codigo);
        
                $resultado = $producto->eliminarProducto();
        
                if ($resultado === 1) {
                    echo json_encode(["success" => "Producto eliminado"]);
                } else {
                    echo json_encode(["error" => "No se pudo eliminar el producto"]);
                }
            } else {
                echo json_encode(["error" => "Codigo del producto no proporcionado"]);
            }
        break;
      }
?>