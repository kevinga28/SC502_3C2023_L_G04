<?php
require_once '../Model/Cita.php';
switch ($_GET["op"]) {

    case 'listaTabla':
        $user_login = new Cita();
        $citas = $user_login->listarCitas();
        // Prepara los datos para DataTables
        $data = array();
        foreach ($citas as $reg) {
            $data[] = array(
                "0" => $reg->getIdCita(),
                "1" =>  $reg->getIdCliente(),
                "2" =>  $reg->getCedulaEmpleado(),
                "3" =>  $reg->getTratamiento(),
                "4" => $reg->getFechaCita(),
                "5" =>  $reg->getHoraCita(),
                // Agrega otros campos según tus necesidades
            );
        }
        $resultados = array(
            "sEcho" => 1, ##informacion para datatables
            "iTotalRecords" => count($data), ## total de registros al datatable
            "iTotalDisplayRecords" => count($data), ## enviamos el total de registros a visualizar
            "aaData" => $data
        );
        echo json_encode($resultados);
        break;

    case 'buscarClientePorId':
        if (isset($_GET['IdCliente'])) {
            $IdCliente = $_GET['IdCliente']; // Obtén el IdCliente de la solicitud GET
            $cliente = Cliente::buscarClientePorId($IdCliente);

            if ($cliente) {
                // Construye un arreglo con los datos del cliente para enviar como respuesta
                $clienteData = array(
                    "Nombre" => $cliente->getNombre(),
                    "Apellido" => $cliente->getApellido(),
                    "Correo" => $cliente->getCorreo(),
                    // Agrega otros campos del cliente según tus necesidades
                );

                echo json_encode($clienteData);
            } else {
                echo json_encode(["error" => "Cliente no encontrado"]);
            }
        } else {
            echo json_encode(["error" => "IdCliente no proporcionado"]);
        }
        break;

    case 'insertar':

        $IdCliente = isset($_POST["IdCliente"]) ? intval($_POST["IdCliente"]) : 0;
        $cedulaEmpleado = isset($_POST["cedulaEmpleado"]) ? intval($_POST["cedulaEmpleado"]) : 0;
        $tratamiento = isset($_POST["tratamiento"]) ? trim($_POST["tratamiento"]) : "";
        $fechaCita = isset($_POST["fechaCita"]) ? trim($_POST["fechaCita"]) : "";
        $horaCita = isset($_POST["horaCita"]) ? trim($_POST["horaCita"]) : "";


        $cita = new Cita();


        $cita->setIdCliente($IdCliente);
        $cita->setCedulaEmpleado($cedulaEmpleado);
        $cita->setTratamiento($tratamiento);
        $cita->setFechaCita($fechaCita);
        $cita->setHoraCita($horaCita);

        $insertado = $cita->crearCita();

        if ($insertado) {
            echo 1; // Éxito en la inserción
        } else {
            echo 0; // Fallo en la inserción
        }
        break;

    case 'editar':

        $IdCita = isset($_POST["IdCita"]) ? intval($_POST["IdCita"]) : 0;
        $IdCliente = isset($_POST["IdCliente"]) ? intval($_POST["IdCliente"]) : 0;
        $cedulaEmpleado = isset($_POST["cedulaEmpleado"]) ? intval($_POST["cedulaEmpleado"]) : 0;
        $tratamiento = isset($_POST["tratamiento"]) ? trim($_POST["tratamiento"]) : "";
        $fechaCita = isset($_POST["fechaCita"]) ? trim($_POST["fechaCita"]) : "";
        $horaCita = isset($_POST["horaCita"]) ? trim($_POST["horaCita"]) : "";


        $cita = new Cita();

        $cita->setIdCita($IdCita);
        $cita->setIdCliente($IdCliente);
        $cita->setCedulaEmpleado($cedulaEmpleado);
        $cita->setTratamiento($tratamiento);
        $cita->setFechaCita($fechaCita);
        $cita->setHoraCita($horaCita);

        // Realiza la actualización en la base de datos
        $actualizado = $cita->actualizarCita();

        if ($actualizado) {
            echo 1; // Éxito en la actualización
        } else {
            echo 0; // Fallo en la actualización
        }
        break;

    case 'eliminar':

        $IdCita = isset($_GET['IdCita']) ? intval($_GET['IdCita']) : 0;

        $cita = new Cita();
        $cita->setIdCita($IdCita);
        $eliminado = $cita->eliminarCita();

        if ($eliminado) {
            echo 1; // Éxito en la eliminación
        } else {
            echo 0; // Fallo en la eliminación
        }
        break;

    case 'obtener':
        if (isset($_GET['IdCita'])) {
            $IdCita = isset($_GET['IdCita']) ? intval($_GET['IdCita']) : null;
            $cita = Cita::obtenerCitaPorIdCita($IdCita);

            if ($cita) {
                // Devuelve los datos de la cita en formato JSON
                echo json_encode($cita);
            } else {
                echo json_encode(["error" => "No se encontró la cita"]);
            }
        } else {
            echo json_encode(["error" => "IdCita de la cita no proporcionada"]);
        }
        break;
}
