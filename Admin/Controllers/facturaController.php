<?php
require_once '../Model/Factura.php';
require_once '../Model/Cita.php';

switch ($_GET["op"]) {

    case 'listaTabla':
        $factura = new Factura();
        $facturas = $factura->listarFacturas();
        $data = array();
        foreach ($facturas as $reg) {
            $data[] = array(
                "0" => $reg['IdFactura'],
                "1" => $reg['IdCita'],
                "2" => $reg['NombreCliente'],
                "3" => $reg['ApellidoCliente'],
                "4" => $reg['Tratamiento'],
                "5" => $reg['NombreProducto'],
                "6" => $reg['MetodoPago'],
                "7" => $reg['PagoTotal']
            );
        }
        $resultados = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($resultados);
        break;

    case 'buscarCita':
        // Asegúrate de recibir y validar los datos necesarios para buscar la cita
        $idCita = isset($_POST["busquedaCitas"]) ? trim($_POST["busquedaCitas"]) : "";

        // Llama a la función de la clase Factura para buscar la cita por el ID
        $factura = new Factura();
        $datosCita = $factura->buscarCitaPorId($idCita);

        if ($datosCita) {
            $response = array(
                'success' => true,
                'cita' => $datosCita // Devuelve todos los datos de la cita y el cliente
            );
            echo json_encode($response);
        } else {
            $response = array('success' => false);
            echo json_encode($response);
        }
        break;


    case 'insertar':
        try {
            $IdCita = isset($_POST["citas"]) ? intval($_POST["citas"]) : 0;
            $metodoPago = isset($_POST["metodoPago"]) ? trim($_POST["metodoPago"]) : "";
            $pagoTotal = isset($_POST["pagoTotalHidden"]) ? trim($_POST["pagoTotalHidden"]) : "";

            // Validación de datos
            if ($IdCita === 0 || empty($metodoPago) || empty($pagoTotal)) {
                echo "Error: Debes proporcionar todos los datos necesarios para crear la cita.";
            } else {
                $factura = new Factura();
                $existeFactura = $factura->existeFacturaParaCita($IdCita); 
                if ($existeFactura) {
                    echo "Error: Ya existe una factura asociada a esta cita.";
                } else {
                    $factura->setIdCita($IdCita);
                    $factura->setMetodoPago($metodoPago);
                    $factura->setPagoTotal($pagoTotal);
                    $idFactura = $factura->agregarFactura();

                    if (is_numeric($idFactura) && $idFactura > 0) {
                        // Verifica si se han enviado producto
                        if (isset($_POST["producto"]) && is_array($_POST["producto"])) {
                            $productos = $_POST["producto"];

                            foreach ($productos as $codigoProducto) {
                                // Utiliza el código de producto para encontrar la cantidad correspondiente
                                $cantidad = isset($_POST["cantidad"]) ? intval($_POST["cantidad"]) : 0;
                                $factura->agregarProductoFactura($idFactura, $codigoProducto, $cantidad);
                            }
                            echo "1"; // Indica éxito
                        } else {
                            echo "1"; // Indica exito pero sin productos
                        }
                    } else {
                        echo "Error: No se pudo crear la cita. Por favor, verifica los datos.";
                    }
                }
            }
        } catch (PDOException $Exception) {
            echo "Error: " . $Exception->getMessage();
        }
        break;


    case 'editar':
        try {
            $IdFactura = isset($_POST["IdFactura"]) ? intval($_POST["IdFactura"]) : 0;
            $IdCita = isset($_POST["citas"]) ? intval($_POST["citas"]) : 0;
            $metodoPago = isset($_POST["metodoPago"]) ? trim($_POST["metodoPago"]) : "";
            $pagoTotal = isset($_POST["pagoTotalHidden"]) ? trim($_POST["pagoTotalHidden"]) : "";

            if ($IdFactura === 0 || $IdCita === 0 || empty($metodoPago) || empty($pagoTotal)) {
                var_dump($IdFactura);
                echo "Error: Debes proporcionar todos los datos necesarios para editar la factura.";
            } else {
                $factura = new Factura();
                $factura->setIdFactura($IdFactura);
                $factura->setIdCita($IdCita);
                $factura->setMetodoPago($metodoPago);
                $factura->setPagoTotal($pagoTotal);

                $resultadoActualizacion = $factura->actualizarFactura();

                if ($resultadoActualizacion > 0) {
                    // Verificar si se han enviado productos
                    if (isset($_POST["producto"]) && is_array($_POST["producto"])) {
                        $productos = $_POST["producto"];

                        // Eliminar productos actuales asociados a la factura
                        $factura->eliminarProductos($IdFactura);

                        foreach ($productos as $codigoProducto) {
                            $cantidad = isset($_POST["cantidad"][$codigoProducto]) ? intval($_POST["cantidad"][$codigoProducto]) : 0;
                            $factura->agregarProductoFactura($IdFactura, $codigoProducto, $cantidad);
                        }
                        echo "1"; // Indica éxito con productos
                    } else {
                        echo "1"; // Indica éxito sin productos
                    }
                } else {
                    echo "Error: No se pudo actualizar la factura. Por favor, verifica los datos.";
                }
            }
        } catch (PDOException $Exception) {
            echo "Error: " . $Exception->getMessage();
        }
        break;

    case 'verificar_existencia_factura':
        $IdFactura = isset($_POST["IdFactura"]) ? trim($_POST["IdFactura"]) : "";
        $factura = new Factura();
        $factura->setIdFactura($IdFactura);
        $encontrado = $factura->verificarExistenciaFactura();
        echo $encontrado ? 1 : 0;
        break;

    case 'obtener':
        $IdFactura = isset($_GET['IdFactura']) ? intval($_GET['IdFactura']) : null;

        if (!empty($IdFactura)) {
            $factura = Factura::obtenerFacturaPorIdFactura($IdFactura);

            if ($factura) {
                echo json_encode($factura);
            } else {
                echo json_encode(["error" => "No se encontró la factura"]);
            }
        } else {
            echo json_encode(["error" => "IdFactura de la factura no proporcionada"]);
        }
        break;

    case 'eliminar':
        if (isset($_POST['id'])) {
            $IdFactura = intval($_POST['id']);
            $factura = new Factura();
            $factura->setIdFactura($IdFactura);

            $resultado = $factura->eliminarFactura($IdFactura);

            if ($resultado > 0) {
                echo "1";
            } else {
                echo "2";
            }
        } else {
            echo "3";
        }
        break;
}
