<?php
require_once '../Model/Factura.php';
require_once '../Model/Cita.php';

switch ($_GET["op"]) {

    case 'listaTabla':
        $factura = new Factura();
        $facturas = $factura->listarFacturas();

        $data = array();
        foreach ($facturas as $reg) {
            // ... (otros campos)
            $data[] = array(
                "0" => $reg->getIdFactura(),
                "1" => $reg->getIdCita(),
                "2" => $reg->getNombreCliente(),
                "3" => $reg->getApellidoCliente(),
                "4" => $reg->getCorreo(),
                "5" => $reg->getNombreProducto(),
                "6" => $reg->getMetodoPago(),
                "7" => $reg->getPagoTotal(),
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
        // Asegúrate de recibir y validar todos los datos necesarios
        $IdCita = isset($_POST["IdCita"]) ? trim($_POST["IdCita"]) : "";
        $codigoProducto = isset($_POST["codigoProducto"]) ? trim($_POST["codigoProducto"]) : "";
        $metodoPago = isset($_POST["metodoPago"]) ? trim($_POST["metodoPago"]) : "";
        $pagoTotal = isset($_POST["pagoTotal"]) ? trim($_POST["pagoTotal"]) : "";

        $factura = new Factura();

        // Configura los atributos del objeto Factura
        $factura->setIdCita($IdCita);
        $factura->setCodigoProducto($codigoProducto);
        $factura->setMetodoPago($metodoPago);
        $factura->setPagoTotal($pagoTotal);

        $factura->agregarFactura();

        echo "Factura agregada exitosamente.";
        break;

    case 'editar':
        $IdFactura = isset($_POST["IdFactura"]) ? trim($_POST["IdFactura"]) : "";
        $IdCita = isset($_POST["IdCita"]) ? trim($_POST["IdCita"]) : "";
        $codigoProducto = isset($_POST["codigoProducto"]) ? trim($_POST["codigoProducto"]) : "";
        $metodoPago = isset($_POST["metodoPago"]) ? trim($_POST["metodoPago"]) : "";
        $pagoTotal = isset($_POST["pagoTotal"]) ? trim($_POST["pagoTotal"]) : "";

        $factura = new Factura();
        $factura->setIdFactura($IdFactura);
        $factura->setIdCita($IdCita);
        $factura->setCodigoProducto($codigoProducto);
        $factura->setMetodoPago($metodoPago);
        $factura->setPagoTotal($pagoTotal);

        $factura->actualizarFactura();

        echo "Factura actualizada exitosamente.";
        break;

    case 'verificar_existencia_factura':
        $IdFactura = isset($_POST["IdFactura"]) ? trim($_POST["IdFactura"]) : "";
        $factura = new Factura();
        $factura->setIdFactura($IdFactura);
        $encontrado = $factura->verificarExistenciaFactura();
        echo $encontrado ? 1 : 0;
        break;

    case 'obtener':
        if (isset($_GET['IdFactura'])) {
            $IdFactura = isset($_GET['IdFactura']) ? intval($_GET['IdFactura']) : null;
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

            if ($resultado === 1) {
                echo json_encode(["success" => "Factura eliminada"]);
            } else {
                echo json_encode(["error" => "No se pudo eliminar la factura"]);
            }
        } else {
            echo json_encode(["error" => "Id de la factura no proporcionado"]);
        }
        break;
}
