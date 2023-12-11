<?php
require_once '../Model/Tratamiento.php';

// Comprueba la operación (op) enviada desde tu aplicación
if (isset($_GET["op"])) {
    switch ($_GET["op"]) {

        case 'listaTabla':
            $tratamiento = new Tratamiento();
            $tratamientos = $tratamiento->listarTratamientos();
            $data = array();
            foreach ($tratamientos as $reg) {
                $data[] = array(
                    "0" => $reg['IdTratamiento'],
                    "1" =>  $reg['nombre'],
                    "2" =>  $reg['descripcion'],
                    "3" =>  $reg['precio'],
                    "4" =>  $reg['duracion'],
                );
            }
            $resultados = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data), ## enviamos el total de registros a visualizar
                "aaData" => $data
            );
            echo json_encode($resultados);
            break;


        case 'insertar':
            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
            $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
            $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";
            $duracion = isset($_POST["duracion"]) ? trim($_POST["duracion"]) : "";

            $tratamiento = new Tratamiento();

            $tratamiento->setNombre($nombre);
            $encontrado = $tratamiento->verificarExistenciaTratamiento();
            if ($encontrado == false) {
                $tratamiento->setNombre($nombre);
                $tratamiento->setDescripcion($descripcion);
                $tratamiento->setPrecio($precio);
                $tratamiento->setDuracion($duracion);
                $tratamiento->guardarEnDb();
                if ($tratamiento->verificarExistenciaTratamiento()) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                echo 3;
            }
            break;

        case 'verificar_existencia_tratamiento':
            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
            $encontrado = $tratamiento->verificarExistenciaTratamiento();
            echo $encontrado ? 1 : 0;
            break;


        case 'editar':
            $IdTratamiento = isset($_POST["IdTratamiento"]) ? intval($_POST["IdTratamiento"]) : 0;
            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
            $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
            $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";
            $duracion = isset($_POST["duracion"]) ? trim($_POST["duracion"]) : "";
            
            $tratamiento = new Tratamiento();
            $tratamiento->setNombre($nombre);
            $encontrado = $tratamiento->verificarExistenciaTratamiento();
            
            if ($encontrado == true) {
                $tratamiento->setIdTratamiento($IdTratamiento);
                $tratamiento->setNombre($nombre);
                $tratamiento->setDescripcion($descripcion);
                $tratamiento->setPrecio($precio);
                $tratamiento->setDuracion($duracion);
            

                if ($tratamiento->actualizarTratamiento()) {
                    echo 1; //exito en la actualizacion
                } else {
                    echo 2;  //Error al guardar en la base de datos
                }
            } else {
                echo 3; //Este valor se muestra si el tratamiento no existe
            }
            break;

        case 'obtener':
            if (isset($_GET['IdTratamiento'])) {
                $IdTratamiento = isset($_GET['IdTratamiento']) ? intval($_GET['IdTratamiento']) : null;
                $tratamiento = Tratamiento::obtenerTratamientoPorId($IdTratamiento);

                if ($tratamiento) {
                    // Devuelve los datos del tratamiento en formato JSON
                    echo json_encode($tratamiento);
                } else {
                    echo json_encode(["error" => "No se encontró el tratamiento"]);
                }
            } else {
                echo json_encode(["error" => "Idtratamiento del tratamiento no proporcionada"]);
            }
            break;

        case 'eliminar':
            if (isset($_POST['id'])) {
                $IdTratamiento = intval($_POST['id']);
                $tratamiento = new Tratamiento();
                $tratamiento->setIdTratamiento($IdTratamiento);

                $resultado = $tratamiento->eliminarTratamiento();

                if ($resultado === 1) {
                    echo "1";
                } else {
                    echo "2";
                }
            } else {
                echo "3";
            }
            break;


        case 'listaTratamiento':
            try {
                $conexion = Conexion::conectar();
                $consulta = "SELECT IdTratamiento, nombre, precio, duracion FROM tratamiento";
                $resultado = $conexion->query($consulta);

                $tratamientos = array();
                while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    $tratamientos[] = $fila;
                }

                echo json_encode($tratamientos);
            } catch (PDOException $ex) {
                echo json_encode(array("error" => "Error de base de datos: " . $ex->getMessage()));
            }
    }
}
