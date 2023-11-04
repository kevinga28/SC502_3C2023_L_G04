<?php
    require_once '../Model/Producto.php';

    switch ($_GET["op"]) {
        
        case 'listaProducto':
            $newProducto = new Producto();
            $productos = $newProducto->leerProductos();
            $data = array();
            foreach ($productos as $reg) {
                $data[] = array(
                    "0" => $reg->getCodigo(),
                    "1" =>  $reg->getNombre(),
                    "2" =>  $reg->getDescripcion(),
                    "3" =>  $reg->getCantidad(),
                    "4" => $reg->getPrecio(),
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
            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
            $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
            $cantidad = isset($_POST["cantidad"]) ? trim($_POST["cantidad"]) : "";
            $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";

            $producto = new Producto();

            $producto->setNombre($nombre);
            $producto->setDescripcion($descripcion);
            $producto->setCantidad($cantidad);
            $producto->setPrecio($precio);

        break;

        case 'editar':
              $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
              $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
              $cantidad = isset($_POST["cantidad"]) ? trim($_POST["cantidad"]) : "";
              $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";

              $producto = new Producto();

              $encontrado = $producto->verificarProducto();
              if ($encontrado == 1) {
                $producto->setCodigo($codigo);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setCantidad($cantidad);
                $producto->setPrecio($precio);

                $modificados = $producto->actualizarUsuario();
                if ($modificados > 0) {
                  echo 1;
                } else {
                  echo 0;
                }
              }else{
                echo 2;	
              }
        break;

        case 'obtener':
            if (isset($_GET['codigo'])) {
                $codigo = isset($_GET['codigo']) ? intval($_GET['codigo']) : null;
                $producto = Producto::obtenerProductoCodigo($codigo);
    
                if ($cliente) {
                    // Devuelve los datos del producto en formato JSON
                    echo json_encode($producto);
                } else {
                    echo json_encode(["error" => "No se encontró el producto"]);
                }
            } else {
                echo json_encode(["error" => "codigo del producto no proporcionado"]);
            }
            break;

        case 'eliminar':
          if (isset($_GET['codigo'])) {
              $codigo = isset($_GET['codigo']) ? intval($_GET['codigo']) : null;
      
              $producto = Producto::obtenerProductoCodigo($codigo);
      
              if ($producto) {
                  // Realiza la eliminación del producto
                  $resultado = $producto->eliminarProducto();
      
                  if ($resultado === 1) {
                      echo json_encode(["success" => "Producto eliminado exitosamente"]);
                  } else {
                      echo json_encode(["error" => "No se pudo eliminar el producto"]);
                  }
              } else {
                  echo json_encode(["error" => "No se encontró el producto"]);
              }
          } else {
              echo json_encode(["error" => "codigo del cliente no proporcionada"]);
          }
          break;
      }
?>