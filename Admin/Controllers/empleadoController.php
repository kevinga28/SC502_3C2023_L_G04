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
        $imagen = isset($_POST["imagen"]) ? file_get_contents($_POST["imagen"]) : "";
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
        $genero = isset($_POST["genero"]) ? trim($_POST["genero"]) : "";
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
        $contrasena = hash('SHA256', $contrasena);
        $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
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
                echo 1; 
            } else {
                echo 2;
            }
        } else {
            echo 3;
        }
        break;

        case 'verificar_existencia_empleado':
            $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
            $empleado->setCorreo($correo);
            $encontrado = $empleado->verificarExistenciaEmpleado();
            echo $encontrado ? 1 : 0;
            break;
    
}
