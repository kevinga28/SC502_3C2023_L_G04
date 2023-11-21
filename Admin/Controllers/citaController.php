<?php
session_start();
require_once '../Model/Cita.php';
switch ($_GET["op"]) {

    case 'listaTabla':
        $cita = new Cita();
        $citas = $cita->listarCitas();
        $data = array();
        foreach ($citas as $reg) {
            $data[] = array(
                "0" => $reg['IdCita'],
                "1" => $reg['IdCliente'],
                "2" => $reg['NombreCliente'],
                "3" => $reg['ApellidoCliente'],
                "4" => $reg['CedulaEmpleado'],
                "5" => $reg['Tratamientos'],
                "6" => $reg['FechaCita'],
                "7" => $reg['HoraCita'],
                "8" => $reg['HoraFin'],

            );
        }
        $resultados = array(
            "sEcho" => 1, ##información para datatables
            "iTotalRecords" => count($data), ## total de registros al datatable
            "iTotalDisplayRecords" => count($data), ## enviamos el total de registros a visualizar
            "aaData" => $data
        );
        echo json_encode($resultados);
        break;

    case 'buscarCliente':
        $idCliente = isset($_POST["busquedaCliente"]) ? trim($_POST["busquedaCliente"]) : "";

        $cita = new Cita();
        $datosCliente = $cita->obtenerDatosClientePorId($idCliente);

        if ($datosCliente) {
            $response = array(
                'success' => true,
                'cliente' => $datosCliente // Devuelve todos los datos del cliente
            );
            echo json_encode($response);
        } else {
            $response = array('success' => false);
            echo json_encode($response);
        }
        break;

    case 'insertar':
        try {
            $IdCliente = isset($_POST["cliente"]) ? intval($_POST["cliente"]) : 0;
            $cedulaEmpleado = isset($_POST["cedulaEmpleado"]) ? intval($_POST["cedulaEmpleado"]) : 0;
            $fechaCita = isset($_POST["fechaCita"]) ? trim($_POST["fechaCita"]) : "";
            $horaCita = isset($_POST["horaCita"]) ? trim($_POST["horaCita"]) : "";
            $horaFin = isset($_POST["horaFin"]) ? trim($_POST["horaFin"]) : "";
            $pagoTotal = isset($_POST["pagoTotalHidden"]) ? trim($_POST["pagoTotalHidden"]) : "";

            // Validación de datos
            if ($IdCliente === 0 || $cedulaEmpleado === 0 || empty($fechaCita) || empty($horaCita) || empty($horaFin) || empty($pagoTotal)) {
                echo "Error: Debes proporcionar todos los datos necesarios para crear la cita.";
            } else {
                $cita = new Cita();
                $cita->setIdCliente($IdCliente);
                $cita->setCedulaEmpleado($cedulaEmpleado);
                $cita->setFechaCita($fechaCita);
                $cita->setHoraCita($horaCita);
                $cita->setHoraFin($horaFin);
                $cita->setPagoTotal($pagoTotal);

                // Crea la cita sin tratamientos y obtén el ID
                $idCita = $cita->crearCitaSinTratamientos();

                if (is_numeric($idCita) && $idCita > 0) {
                    // Verifica si se han enviado tratamientos
                    if (isset($_POST["tratamiento"]) && is_array($_POST["tratamiento"]) && !empty($_POST["tratamiento"])) {
                        $tratamientos = $_POST["tratamiento"];
                        foreach ($tratamientos as $idTratamiento) {
                            $cita->agregarTratamientoACita($idCita, $idTratamiento);
                        }
                        echo "1"; // Indica éxito
                    } else {
                        echo "Error: Debes seleccionar al menos un tratamiento.";
                    }
                } else {
                    echo "Error: No se pudo crear la cita. Por favor, verifica los datos.";
                }
            }
        } catch (PDOException $Exception) {
            echo "Error: " . $Exception->getMessage();
        }
        break;

    case 'editar':
        try {
            // Obtiene el ID de la cita
            $idCita = isset($_POST["IdCita"]) ? intval($_POST["IdCita"]) : 0;

            $IdCliente = isset($_POST["cliente"]) ? intval($_POST["cliente"]) : 0;
            $cedulaEmpleado = isset($_POST["cedulaEmpleado"]) ? intval($_POST["cedulaEmpleado"]) : 0;
            $fechaCita = isset($_POST["fechaCita"]) ? trim($_POST["fechaCita"]) : "";
            $horaCita = isset($_POST["horaCita"]) ? trim($_POST["horaCita"]) : "";
            $horaFin = isset($_POST["horaFin"]) ? trim($_POST["horaFin"]) : "";
            $pagoTotal = isset($_POST["pagoTotalHidden"]) ? trim($_POST["pagoTotalHidden"]) : "";

            // Verifica si se han enviado tratamientos
            if (isset($_POST["tratamiento"]) && is_array($_POST["tratamiento"])) {
                $tratamientos = $_POST["tratamiento"];
            } else {
                $tratamientos = array();
            }

            // Validación de datos
            if ($idCita === 0 || $IdCliente === 0 || $cedulaEmpleado === 0 || empty($fechaCita) || empty($horaCita) || empty($horaFin) || empty($pagoTotal)) {
                echo "Error: Debes proporcionar todos los datos necesarios para editar la cita.";
            } else {
                $cita = new Cita();
                $cita->setIdCita($idCita);
                $cita->setIdCliente($IdCliente);
                $cita->setCedulaEmpleado($cedulaEmpleado);
                $cita->setFechaCita($fechaCita);
                $cita->setHoraCita($horaCita);
                $cita->setHoraFin($horaFin);
                $cita->setPagoTotal($pagoTotal);

                // Elimina todos los tratamientos de la cita
                $cita->eliminarTratamientos($idCita);

                $actualizado = $cita->actualizarCita();

                if ($actualizado) {
                    // Verifica si se han enviado tratamientos antes de intentar iterar
                    if (!empty($tratamientos)) {
                        foreach ($tratamientos as $idTratamiento) {
                            $cita->agregarTratamientoACita($idCita, $idTratamiento);
                        }
                    }
                    echo "1"; // Éxito en la actualización
                } else {
                    echo "Error: No se pudo actualizar la cita. Por favor, verifica los datos.";
                }
            }
        } catch (PDOException $Exception) {
            echo "Error: " . $Exception->getMessage();
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

    case 'eliminar':
        if (isset($_POST['id'])) {
            $IdCita = intval($_POST['id']);
            $cita = new Cita();
            $cita->setIdCita($IdCita);

            $resultado = $cita->eliminarCita($IdCita);

            if ($resultado > 0) {
                echo "1";
            } else {
                echo "2";
            }
        } else {
            echo "3";
        }
        break;

    case 'cargarCita':
        $citaModel = new Cita();
        $citas = $citaModel->obtenerCitas();
        echo json_encode($citas);
        break;
    case 'cargarCitaCalendario':
        $cedulaEmpleado = $_SESSION['cedula'];
        $rol = $_SESSION['rol'];

        $citaModel = new Cita();
        if($_SESSION['rol']==='Admin'){
            $citas = $citaModel->obtenerCitasCalendarioAdmin($_SESSION['rol']);

        }else if($_SESSION['rol']==='Estilista'){
            $citas =$citaModel->obtenerCitasCalendarioEstilista($_SESSION['cedula'],$_SESSION['rol']);

        }

        echo json_encode($citas);
        break;

}
