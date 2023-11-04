<?php
require_once '../models/Factura.php'; // Asegúrate de cambiar el nombre de la clase si es diferente

if (isset($_GET["op"])) {
    $operacion = $_GET["op"];
    $factura = new Factura(); // Asegúrate de que coincida con el nombre de tu clase

    switch ($operacion) {
        case 'listar_facturas':
            $facturas = $factura->listarFacturas();
            echo json_encode($facturas);
            break;

        case 'verificar_existencia':
            $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
            $factura->setCorreo($correo);
            $encontrado = $factura->verificarExistenciaDb();
            echo $encontrado ? 1 : 0;
            break;


        case 'guardar_factura':
            // Asegúrate de recibir y validar todos los datos necesarios
            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
            $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
            $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
            $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
            $tipoCliente = isset($_POST["tipoCliente"]) ? trim($_POST["tipoCliente"]) : "";
            $tratamiento = isset($_POST["tratamiento"]) ? trim($_POST["tratamiento"]) : "";
            $metodoPago = isset($_POST["metodoPago"]) ? trim($_POST["metodoPago"]) : "";
            $estilista = isset($_POST["estilista"]) ? trim($_POST["estilista"]) : "";
            $totalPago = isset($_POST["totalPago"]) ? trim($_POST["totalPago"]) : "";
            $fechaCita = isset($_POST["fechaCita"]) ? trim($_POST["fechaCita"]) : "";
            $horaCita = isset($_POST["horaCita"]) ? trim($_POST["horaCita"]) : "";


            $factura = new Factura();
            $factura ->setId($id);
            
            // Configura los atributos del objeto Factura
            $factura->setNombre($nombre);
            $factura->setApellido($apellido);
            $factura->setCorreo($correo);
            $factura->setTelefono($telefono);
            $factura->setTipoCliente($tipoCliente);
            $factura->setTratamiento($tratamiento);
            $factura->setMetodoPago($metodoPago);
            $factura->setEstilista($estilista);
            $factura->setTotalPago($totalPago);
            $factura->setFechaCita($fechaCita);
            $factura->setHoraCita($horaCita);

            // Intenta guardar la factura en la base de datos
            $factura->guardarEnDb();

            break;

        case 'mostrar_factura':
            $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
            $factura = Factura::mostrarPorCorreo($correo);
            echo json_encode($factura);
            break;

        case 'editar_factura':
            $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";

            // Asegúrate de recibir y validar todos los datos necesarios
            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
            $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
            $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
            $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
            $tipoCliente = isset($_POST["tipoCliente"]) ? trim($_POST["tipoCliente"]) : "";
            $tratamiento = isset($_POST["tratamiento"]) ? trim($_POST["tratamiento"]) : "";
            $metodoPago = isset($_POST["metodoPago"]) ? trim($_POST["metodoPago"]) : "";
            $estilista = isset($_POST["estilista"]) ? trim($_POST["estilista"]) : "";
            $totalPago = isset($_POST["totalPago"]) ? trim($_POST["totalPago"]) : "";
            $fechaCita = isset($_POST["fechaCita"]) ? trim($_POST["fechaCita"]) : "";
            $horaCita = isset($_POST["horaCita"]) ? trim($_POST["horaCita"]) : "";


            $factura = new Factura();
            $factura->setId($id);
            $encontrado = $factura->verificarExistenciaDb();
            if ($encontrado == 1) {
                $factura->llenarCampos($id);
                // Configura los atributos del objeto Factura
                $factura->setNombre($nombre);
                $factura->setApellido($apellido);
                $factura->setCorreo($correo);
                $factura->setTelefono($telefono);
                $factura->setTipoCliente($tipoCliente);
                $factura->setTratamiento($tratamiento);
                $factura->setMetodoPago($metodoPago);
                $factura->setEstilista($estilista);
                $factura->setTotalPago($totalPago);
                $factura->setFechaCita($fechaCita);
                $factura->setHoraCita($horaCita);
                    $modificados-> $factura->actualizarFactura();
                    if ($modificados > 0) {
                        echo 1;
                      } else {
                        echo 0;
                      }
                    }
                    else{
                      echo 2;	
                    }
                
            break;
            