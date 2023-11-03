<?php
require_once '../Model/Cliente.php';
switch ($_GET["op"]) {

    case 'listaTabla':
        $user_login = new Cliente();
        $clientes = $user_login->listarClientes();
        // Prepara los datos para DataTables
        $data = array();
        foreach ($clientes as $reg) {
            $data[] = array(
                "0" => $reg->getCedula(),
                "1" =>  $reg->getCorreo(),
                "2" =>  $reg->getNombre(),
                "3" =>  $reg->getApellido(),
                "4" => $reg->getTelefono(),
                "5" =>  $reg->getGenero(),

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

    case 'insertar':


        // Asegúrate de recibir y validar todos los datos necesarios
        $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
        $genero = isset($_POST["genero"]) ? trim($_POST["genero"]) : "";
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
        $contrasena = hash('SHA256', $contrasena);
        $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
        $tipoCliente = isset($_POST["tipoCliente"]) ? trim($_POST["tipoCliente"]) : "";
        $provincia = isset($_POST["provincia"]) ? trim($_POST["provincia"]) : "";
        $distrito = isset($_POST["distrito"]) ? trim($_POST["distrito"]) : "";
        $canton = isset($_POST["canton"]) ? trim($_POST["canton"]) : "";
        $otros = isset($_POST["otros"]) ? trim($_POST["otros"]) : "";


        $cliente = new Cliente();

        // Configura los atributos del objeto Cliente
        $cliente->setCedula($cedula);
        $cliente->setCorreo($correo);
        $encontrado = $cliente->verificarExistenciaCliente();
        if ($encontrado == false) {
            $cliente->setNombre($nombre);
            $cliente->setApellido($apellido);
            $cliente->setGenero($genero);
            $cliente->setContrasena($contrasena);
            $cliente->setTelefono($telefono);
            $cliente->setTipoCliente($tipoCliente);
            $cliente->setProvincia($provincia);
            $cliente->setDistrito($distrito);
            $cliente->setCanton($canton);
            $cliente->setOtros($otros);
            $cliente->guardarEnDb();
            if ($cliente->verificarExistenciaCliente()) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 3;
        }
        break;

    case 'verificar_existencia_cliente':
        $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $cliente->setCedula($cedula);
        $cliente->setCorreo($correo);
        $encontrado = $cliente->verificarExistenciaCliente();
        echo $encontrado ? 1 : 0;
        break;



    case 'mostrar':
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $cliente = Cliente::mostrar($correo);
        echo json_encode($cliente);
        break;

    case 'editar':
        // Asegúrate de recibir y validar todos los datos necesarios
        $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
        $nueva_cedula = isset($_POST["nueva_cedula"]) ? trim($_POST["nueva_cedula"]) : ""; // Nueva cédula
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
        $genero = isset($_POST["genero"]) ? trim($_POST["genero"]) : "";
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
        $tipoCliente = isset($_POST["tipoCliente"]) ? trim($_POST["tipoCliente"]) : "";
        $provincia = isset($_POST["provincia"]) ? trim($_POST["provincia"]) : "";
        $distrito = isset($_POST["distrito"]) ? trim($_POST["distrito"]) : "";
        $canton = isset($_POST["canton"]) ? trim($_POST["canton"]) : "";
        $otros = isset($_POST["otros"]) ? trim($_POST["otros"]) : "";

        $cliente = new Cliente();
        $cliente->setCedula($cedula);

        $encontrado = $cliente->verificarExistenciaCliente();
        if ($encontrado == 1) {
            // Utiliza la nueva cédula en la consulta SQL para actualizarla
            $cliente->setCedula($nueva_cedula);
            $cliente->setNombre($nombre);
            $cliente->setApellido($apellido);
            $cliente->setGenero($genero);
            $cliente->setCorreo($correo);
            $cliente->setTelefono($telefono);
            $cliente->setTipoCliente($tipoCliente);
            $cliente->setProvincia($provincia);
            $cliente->setDistrito($distrito);
            $cliente->setCanton($canton);
            $cliente->setOtros($otros);

            $modificados = $cliente->actualizarCliente();

            if ($modificados > 0) {
                echo 1; // Éxito en la actualización
            } else {
                echo 0; // No se realizaron modificaciones
            }
        } else {
            echo 2; // El cliente no existe
        }
        break;
    case 'obtener':
        if (isset($_GET['cedula'])) {
            $cedula = isset($_GET['cedula']) ? intval($_GET['cedula']) : null;
            $cliente = Cliente::obtenerClientePorCedula($cedula);

            if ($cliente) {
                // Devuelve los datos del cliente en formato JSON
                echo json_encode($cliente);
            } else {
                echo json_encode(["error" => "No se encontró el cliente"]);
            }
        } else {
            echo json_encode(["error" => "Cédula del cliente no proporcionada"]);
        }
        break;
}
