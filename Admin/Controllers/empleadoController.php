<?php
require_once '../Model/Empleado.php';
switch ($_GET["op"]) {

    case 'listaEmpleados':
        $empleado = new Empleado();
        $empleados = $empleado->listarEmpleados();
        // Prepara los datos para DataTables
        $data = array();
        foreach ($empleados as $item) {
            $data[] = array(
                "0" => $item->getCedula(),
                "1" =>  $item->getCorreo(),
                "2" =>  $item->getNombre(),
                "3" =>  $item->getApellido(),
                "4" => $item->getTelefono(),
                "5" =>  $item->getRol(),
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

    case 'insertar':
        // Asegúrate de recibir y validar todos los datos necesarios
        $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
        if (strlen($cedula) != 9) {
            echo 'La cédula debe tener exactamente 9 dígitos.';
            exit;
        }
        if (!empty($_FILES['imagen']['name'])) {
            // Ruta de la carpeta donde se guardará la imagen
            $carpetaDestino = '../Views/dist/img/';

            // Nombre de la imagen
            $imagen = $_FILES['imagen']['name'];

            // Ruta completa donde se guardará la imagen
            $rutaImagen = $carpetaDestino . $imagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);
        } else {
            // No se ha enviado ninguna imagen
            echo 'Debe seleccionar una imagen.';
            exit;
        }
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
        $genero = isset($_POST["genero"]) ? trim($_POST["genero"]) : "";
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
        if (strlen($contrasena) < 8) {
            echo 'La contraseña debe tener al menos 8 caracteres.';
            exit;
        }
        $contrasena = hash('SHA256', $contrasena);

        $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
        if (strlen($telefono) != 8) {
            echo 'El teléfono debe tener exactamente 8 dígitos.';
            exit;
        }

        $rol = isset($_POST["rol"]) ? trim($_POST["rol"]) : "";
        $provincia = isset($_POST["provincia"]) ? trim($_POST["provincia"]) : "";
        $distrito = isset($_POST["distrito"]) ? trim($_POST["distrito"]) : "";
        $canton = isset($_POST["canton"]) ? trim($_POST["canton"]) : "";
        $otros = isset($_POST["otros"]) ? trim($_POST["otros"]) : "";



        $empleado = new Empleado();

        // Configura los atributos del objeto Empleado
        $empleado->setCorreo($correo);
        $encontrado = $empleado->verificarExistenciaEmpleado();
        if ($encontrado == false) {
            $empleado->setCedula($cedula);
            $empleado->setImagen($imagen);
            $empleado->setNombre($nombre);
            $empleado->setApellido($apellido);
            $empleado->setGenero($genero);
            $empleado->setContrasena($contrasena);
            $empleado->setTelefono($telefono);
            $empleado->setRol($rol);
            $empleado->setProvincia($provincia);
            $empleado->setDistrito($distrito);
            $empleado->setCanton($canton);
            $empleado->setOtros($otros);
            $empleado->insertar();
            if ($empleado->verificarExistenciaEmpleado()) {
                echo 1; // Éxito
            } else {
                echo 2;
            }
        } else {
            echo 3;
        }
        break;

    case 'verificar_existencia_empleado':
        $Cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $empleado->setCorreo($correo);
        $empleado->setCedula($Cedula);
        $encontrado = $empleado->verificarExistenciaEmpleado();
        echo $encontrado ? 1 : 0;
        break;


    case 'editar':
        // Obtén los datos enviados por el formulario
        $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
        $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
        if (strlen($telefono) != 8) {
            echo 'El teléfono debe tener exactamente 8 dígitos.';
            exit;
        }
        $rol = isset($_POST["rol"]) ? trim($_POST["rol"]) : "";
        $provincia = isset($_POST["provincia"]) ? trim($_POST["provincia"]) : "";
        $distrito = isset($_POST["distrito"]) ? trim($_POST["distrito"]) : "";
        $canton = isset($_POST["canton"]) ? trim($_POST["canton"]) : "";
        $otros = isset($_POST["otros"]) ? trim($_POST["otros"]) : "";

        $empleado = new Empleado();
        $encontrado = $empleado->verificarExistenciaEmpleado();

        if ($encontrado == false) {
            $empleado->setCedula($cedula);
            $empleado->setNombre($nombre);
            $empleado->setApellido($apellido);
            $empleado->setTelefono($telefono);
            $empleado->setRol($rol);
            $empleado->setProvincia($provincia);
            $empleado->setDistrito($distrito);
            $empleado->setCanton($canton);
            $empleado->setOtros($otros);

            if ($empleado->actualizarEmpleado()) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 3;
        }

        break;

    case 'obtener':
        if (isset($_GET['cedula'])) {
            $cedula = isset($_GET['cedula']) ? intval($_GET['cedula']) : null;
            $empleado = Empleado::obtenerEmpleadoPorCedula($cedula);

            if ($empleado) {
                // Devuelve los datos del empleado en formato JSON
                echo json_encode($empleado);
            } else {
                echo json_encode(["error" => "No se encontró el empleado"]);
            }
        } else {
            echo json_encode(["error" => "Cedula del empleado no proporcionada"]);
        }
        break;

    case 'eliminar':
        if (isset($_POST['ced'])) {
            $cedula = intval($_POST['ced']);
            $empleado = new Empleado();
            $empleado->setCedula($cedula);


            $resultado = $empleado->eliminarEmpleado($cedula);

            if ($resultado === 1) {
                echo json_encode(["success" => "empleado eliminado"]);
            } else {
                echo json_encode(["error" => "No se pudo eliminar el empleado"]);
            }
        }
        break;

    case 'cargarEstilistas':
        $empleadoModel = new Empleado();
        $estilistas = $empleadoModel->obtenerEstilistas();
        echo json_encode($estilistas);
        break;
}
